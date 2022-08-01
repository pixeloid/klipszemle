<?php

namespace App\Controller;

use App\Entity\BudgetCategory;
use App\Entity\UserTitle;
use App\Form\EventRegistrationFlow;
use JetBrains\PhpStorm\ArrayShape;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Swift_Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\EventRegistration;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

/**
 * EventRegistration controller.
 */
class EventRegistrationController extends AbstractController
{

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/shortlist", name="shortlist_index")
     */
    public function shortlistAction()
    {
        $em = $this->getDoctrine()->getManager();


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
        $em = $this->getDoctrine()->getManager();

       // $registrations = $em->getRepository('App:EventRegistration')->findAll();
        $categories = $em->getRepository('App:MovieCategory')->findAll();
        $stat = array(
            'shortlist' => $em->getRepository('App:EventRegistration')->findBy(array('shortlist' => true)),
            'onshow' => $em->getRepository('App:EventRegistration')->findBy(array('onshow' => true)),
            'premiere' => $em->getRepository('App:EventRegistration')->findBy(array('premiere' => true)),

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
        $em = $this->getDoctrine()->getManager();

        $registrations = $em->getRepository('App:EventRegistration')->findAll();
        
        $qb = $em->createQueryBuilder();
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


        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('App:EventRegistration')->findOneById($id);


        return [
         'reg' => $video,
        ];
    }


    public function generateVotesheet($id)
    {

        set_time_limit(100000);

        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('App:EventRegistration')->findOneById($id);


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
     * @param Swift_Mailer $mailer
     * @return RedirectResponse|Response
     */
    public function createAction(
        Request                      $request,
        EventRegistrationFlow        $flow,
        Swift_Mailer                $mailer
    ) {
        $entity = new EventRegistration();
        $em = $this->getDoctrine()->getManager();


        $flow = $this->createCreateForm($entity, $flow);

        $form = $flow->createForm();


        if ($flow->isValid($form)) {
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished

                $entity->setUser($this->getUser());
                    
                $em->persist($entity);
                $em->flush();


                $flow->reset(); // remove step data from the session

                // $userManager = $this->get('fos_user.user_manager');

                // $user = $userManager->findUserByEmail($entity->getUser()->getEmail());
                // $token = new UsernamePasswordToken($user, $user->getPassword(), "public", $user->getRoles());
                // $this->get("security.context")->setToken($token);

                $message = (new \Swift_Message('Regisztráció visszaigazolása - Magyar Klipszemle nevezés'))
                    ->setFrom(['info@klipszemle.com' => "Magyar Klipszemle"])
                    ->setTo(array($entity->getUser()->getEmail()))
                    ->setBody(
                        $this->renderView('EventRegistration/success-mail.html.twig', array(
                            'entity'      => $entity,
                            'plainpass' => $plainpass,
                        )),
                        'text/html'
                    );

                $mailer->send($message);


                $message = (new \Swift_Message('Regisztráció visszaigazolása - Magyar Klipszemle nevezés'))
                    ->setFrom(['info@klipszemle.com' => "Magyar Klipszemle"])
                    ->setTo(array('info.klipszemle@gmail.com', 'olah.gergely@pixeloid.hu'))
                    ->setBody(
                        $this->renderView('EventRegistration/success-mail.html.twig', array(
                            'entity'      => $entity,
                            'plainpass' => $plainpass,
                        )),
                        'text/html'
                    );

                $mailer->send($message);


                return $this->redirect(
                    $this->generateUrl('eventregistration_success', ['id' => $entity->getId()])
                );
            }
        }




        return $this->render('EventRegistration/new_flow.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'flow'   => $flow,
        ));
    }


    public function rebuildAction()
    {
        $em = $this->getDoctrine()->getManager();

        $regs = $em->getRepository('App:EventRegistration')->findAll();
        foreach ($regs as $reg) {
            $budget = $em->getRepository(BudgetCategory::class)->findOneById($reg->getBudget() + 1);
            $title = $em->getRepository(UserTitle::class)->findOneById($reg->getTitle() + 1);
            $reg->setBudgetCategory($budget);
            $reg->setUserTitle($title);
            foreach ($reg->getCategories() as $cat) {
                $category = $em->getRepository('App:MovieCategory')->findOneById($cat + 1);
                $reg->addMovieCategory($category);
            }
            $em->persist($reg);
        }

        $em->flush();
    }


    /**
     * @IsGranted("EVENTREGISTRATION_CREATE")
     * @Route("/registration", name="eventregistration_new")
     * @param Request $request
     * @param EventRegistrationFlow $flow
     * @return Response
     */

    public function newAction(Request $request, EventRegistrationFlow $flow): Response
    {

        $entity = new EventRegistration();

        $flow = $this->createCreateForm($entity, $flow);

        $form = $flow->createForm();
        
        return $this->render('EventRegistration/new_flow.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'flow'   => $flow,
        ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}/show", name="eventregistration_show", options={"expose": true})
     */
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();


        $entity = $em->getRepository('App:EventRegistration')->find($id);

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
            $em->persist($entity);
            $em->flush();
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:EventRegistration')->findOneById($id);
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
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:EventRegistrationCategory')->find($id);
        
        $entity->setShortlist($flag);
        $em->persist($entity);
        $em->flush();

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
