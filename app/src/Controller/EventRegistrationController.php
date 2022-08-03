<?php

namespace App\Controller;

use App\Entity\BudgetCategory;
use App\Entity\UserTitle;
use App\Form\EventRegistrationFlow;
use App\Form\EventRegistrationType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use JetBrains\PhpStorm\ArrayShape;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\EventRegistration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * EventRegistration controller.
 */
class EventRegistrationController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    /**
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }


    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/shortlist", name="shortlist_index")
     */
    public function shortlistAction()
    {


        $datatable = $this->get('pixeloid_app.datatable.shortlist');
        $datatable->buildDatatable();

        return $this->render('EventRegistration/shortlist.html.twig', array(
       //     'registrations' => $registrations,
            'datatable' => $datatable,
        ));
    }
    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/stat", name="eventregistration_stat")
     */
    public function statAction()
    {

       // $registrations = $this->entityManager->getRepository('App:EventRegistration')->findAll();
        $categories = $this->entityManager->getRepository('App:MovieCategory')->findAll();
        $stat = array(
            'shortlist' => $this->entityManager->getRepository('App:EventRegistration')->findBy(array('shortlist' => true)),
            'onshow' => $this->entityManager->getRepository('App:EventRegistration')->findBy(array('onshow' => true)),
            'premiere' => $this->entityManager->getRepository('App:EventRegistration')->findBy(array('premiere' => true)),

        );


        return $this->render('EventRegistration/stat.html.twig', array(
           'categories' => $categories,
           'stat' => $stat,
        ));
    }

    /**
     * @Template("EventRegistration/votesheets.html.twig")
     */

    public function votesheetsAction()
    {


        $qb = $this->entityManager->createQueryBuilder();
        $qb->select(array('r')) // string 'u' is converted to array internally
           ->from('App:EventRegistration', 'r')
           ->where("r.created > :date")
           ->andWhere("r.onshow = :os")
           ->orWhere("r.premiere = :pr")
           ->setParameters(array(
               'os' => true,
               'pr' => true,
               'date' =>  new \DateTime('2016-07-01')
           ));

        $video = $qb->getQuery()->getResult();

        foreach ($video as $v) {
            $this->generateVotesheet($v->getId());
        }


        // return array(
        //     'registrations' => ,
        // );
    }

    /**
     * @Route("/votesheet_generator/{id}", name="votesheet_generator")
     * @Template("EventRegistration/votesheet.html.twig")
     */
    #[ArrayShape(['reg' => "mixed"])] public function votesheetGeneratorAction($id)
    {


        $video = $this->entityManager->getRepository('App:EventRegistration')->findOneById($id);


        return [
         'reg' => $video,
        ];
    }


    public function generateVotesheet($id)
    {

        set_time_limit(100000);

        $video = $this->entityManager->getRepository('App:EventRegistration')->findOneById($id);


        $filename = sprintf(
            "votesheets/klipszemle2016---%s-%s.pdf",
            $this->slugify($video->getAuthor()),
            $this->slugify($video->getSongtitle())
        );

        $this->get('knp_snappy.pdf')->getInternalGenerator()->setTimeout(300);
        $this->get('knp_snappy.pdf')->getInternalGenerator();
        $this->get('knp_snappy.pdf')->generate(
            'http://klipszemle.hu/eventregistration/votesheet_generator/' . $video->getId(),
            $filename
        );
    }

    private function slugify($text)
    {
      // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
        $text = trim($text, '-');

      // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

      // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }


    /**
     * @Route("/create", name="eventregistration_create")
     * @param Request $request
     * @param EventRegistrationFlow $flow
     * @return RedirectResponse|Response
     * @throws TransportExceptionInterface
     */
    public function createAction(
        MailerInterface                $mailer,
        EntityManagerInterface $entityManager,
        Request $request
    ): RedirectResponse|Response {
        $entity = new EventRegistration();


        $form = $this->createForm(EventRegistrationType::class, $entity, [
            'action' => $this->generateUrl('eventregistration_create'),
            'method' => 'POST',
        ]);




        return $this->render('EventRegistration/new_flow.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }


    public function rebuildAction()
    {
        $em = $this->em;

        $regs = $this->entityManager->getRepository('App:EventRegistration')->findAll();
        foreach ($regs as $reg) {
            $budget = $this->entityManager->getRepository(BudgetCategory::class)->findOneById($reg->getBudget() + 1);
            $title = $this->entityManager->getRepository(UserTitle::class)->findOneById($reg->getTitle() + 1);
            $reg->setBudgetCategory($budget);
            $reg->setUserTitle($title);
            foreach ($reg->getCategories() as $cat) {
                $category = $this->entityManager->getRepository('App:MovieCategory')->findOneById($cat + 1);
                $reg->addMovieCategory($category);
            }
            $this->entityManager->persist($reg);
        }

        $this->entityManager->flush();
    }


    /**
     * @IsGranted("EVENTREGISTRATION_CREATE")
     * @Route("/registration", name="eventregistration_new")
     * @return Response
     * @throws TransportExceptionInterface
     */

    public function newAction(Request $request, EntityManagerInterface $entityManager, MailerInterface $mailer): Response
    {

        $entity = new EventRegistration();

        $form = $this->createForm(EventRegistrationType::class, $entity, [
            'action' => $this->generateUrl('eventregistration_new'),
            'method' => 'POST',
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entity->setUser($this->getUser());
            preg_match(
                '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                $entity->getVideoUrl(),
                $match
            );
            $youtube_id = $match[1];

            $entity->setYtId($youtube_id);

            $entityManager->persist($entity);
            $entityManager->flush();




            $email = (new TemplatedEmail())
                ->subject('Nevezés visszaigazolása - 06. Magyar Klipszemle')
                ->from('klipszemle.info@gmail.com')
                ->to($entity->getUser()->getEmail())
                ->htmlTemplate('EventRegistration/success-mail.html.twig')
                ->context([
                    'entity'      => $entity,
                ])
            ;
            $mailer->send($email);



            $email = (new TemplatedEmail())
                ->subject('Nevezés visszaigazolása - 06. Magyar Klipszemle')
                ->from('klipszemle.info@gmail.com')
                ->to('klipszemle.info@gmail.com')
                ->htmlTemplate('EventRegistration/success-mail.html.twig')
                ->context([
                    'entity'      => $entity,
                ])
            ;
            $mailer->send($email);



            return $this->redirect(
                $this->generateUrl('eventregistration_success', ['id' => $entity->getId()])
            );
        }

        return $this->render('EventRegistration/new_flow.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}/show", name="eventregistration_show", options={"expose": true})
     */
    public function showAction($id, Request $request)
    {

        $user = $this->getUser();


        $entity = $this->entityManager->getRepository('App:EventRegistration')->find($id);

        if (!$entity || $entity->getUser() !== $user
            && !$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
            throw $this->createNotFoundException('Unable to find EventRegistration entity.');
        }


        $form = $this->createFormBuilder($entity)
            ->add('number', 'text')
            ->add('save', 'submit', array('label' => 'Mentés'))
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $this->entityManager->persist($entity);
            $this->entityManager->flush();
            return $this->redirectToRoute('eventregistration_show', array('id' => $entity->getId()));
        }



        $page = $this->render('EventRegistration/show.html.twig', array(
            'reg'      => $entity,
            'form' => $form->createView(),

        ));


        return $page;
    }

    /**
     * @Route("/success/{id}", name="eventregistration_success")
     */
    public function registrationSuccessAction($id): Response
    {

        $entity = $this->entityManager->getRepository(EventRegistration::class)->findOneById($id);
        return $this->render('EventRegistration/success.html.twig', array(
          'reg' => $entity,
        ));
    }

    /**
     * Creates a form to create a EventRegistration entity.
     *
     * @param EventRegistration $entity The entity
     *
     * @return EventRegistrationFlow The form
     */
    private function createCreateForm(EventRegistration $entity, EventRegistrationFlow $flow): EventRegistrationFlow
    {


        $flow->bind($entity);

        $flow->setGenericFormOptions(array(
            'action' => $this->generateUrl('eventregistration_create'),
            'method' => 'POST',
        ));


        return $flow;
    }

    public function addToShortlistAction(Request $request, $id, $flag): RedirectResponse
    {

        $entity = $this->entityManager->getRepository('App:EventRegistrationCategory')->find($id);
        
        $entity->setShortlist($flag);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);
    }

    private function generatePassword($length = 8)
    {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
}
