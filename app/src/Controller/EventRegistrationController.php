<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\EventRegistrationFlow;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\EventRegistration;
use App\Entity\EventRegistrationCategory;
use App\Form\EventRegistrationEditType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Security\Core\Encoder\PasswordEncoderInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * EventRegistration controller.
 */
class EventRegistrationController extends AbstractController
{
    private $passwordEncoder;

    /**
     * @Security("has_role('ROLE_ADMIN')")
     * @Method("GET")
     * @Template(":post:index.html.twig")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $datatable = $this->get('pixeloid_app.datatable.eventregistration');
        $datatable->buildDatatable();

        return $this->render('EventRegistration/index.html.twig', array(
       //     'registrations' => $registrations,
            'datatable' => $datatable,
        ));
    }

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
     * @Method("GET")
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
     * @Method("GET")
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
    public function votesheetGeneratorAction($id)
    {


        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('App:EventRegistration')->findOneById($id);


        return                 array(
                     'reg' => $video,
                );

    }


    function generateVotesheet($id){

        set_time_limit(100000);

        $em = $this->getDoctrine()->getManager();
        $video = $em->getRepository('App:EventRegistration')->findOneById($id);


        $filename = 'votesheets/klipszemle2016---' . $this->slugify($video->getAuthor()) .'-'. $this->slugify($video->getSongtitle()) . '.pdf';

        $this->get('knp_snappy.pdf')->getInternalGenerator()->setTimeout(300);
        $this->get('knp_snappy.pdf')->getInternalGenerator();
        $this->get('knp_snappy.pdf')->generate(
            'http://klipszemle.hu/eventregistration/votesheet_generator/' . $video->getId()
            ,$filename
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
     * Get all Post entities.
     *
     * @Route("/shortlist-results", name="shortlist_results")
     *
     * @return Response
     */

    public function shortlistResultsAction()
    {
        $datatable = $this->get('pixeloid_app.datatable.shortlist');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        $function = function($qb)
        {
            $qb->andWhere("eventregistration.shortlist = :r");
            $qb->andWhere("eventregistration.created > :date");
            $qb->setParameters(array(
                'r' => true,
                'date' =>  new \DateTime('2016-07-01')
            ));
        };

        // // $query->addWhereAll($function);

        // // return $query->getResponse();
        $query->addWhereAll($function);

        // // Or add the callback function as WhereAll
        // //$query->addWhereAll($function);

        // // Or to the actual query
        // $query->buildQuery();
        // $qb = $query->getQuery();

        // //$qb->addSelect("eventregistration.email");
        // //$qb->andWhere("moviecategories.shortlist = 1");

            // var_dump($qb->getQuery()->getSQL());
            // exit;

        // $query->setQuery($qb);
        return $query->getResponse();

    }



    /**
     * Get all Post entities.
     *
     * @Route("/results", name="eventregistration_results")
     *
     * @return Response
     */

    public function indexResultsAction()
    {
        $datatable = $this->get('pixeloid_app.datatable.eventregistration');
        $datatable->buildDatatable();

        $query = $this->get('sg_datatables.query')->getQueryFrom($datatable);

        $function = function($qb)
        {
            // $qb->andWhere("post.title = :p");
            $qb->andWhere("eventregistration.created > :date");
            $qb->setParameter('date', new \DateTime($this->container->getParameter('start_date')));
        };

        // $query->addWhereAll($function);

        // return $query->getResponse();
        $query->addWhereAll($function);

        // // Or add the callback function as WhereAll
        // //$query->addWhereAll($function);

        // // Or to the actual query
        // $query->buildQuery();
        // $qb = $query->getQuery();

        // //$qb->addSelect("eventregistration.email");
        // //$qb->andWhere("moviecategories.shortlist = 1");

        //     // var_dump($qb->getQuery()->getSQL());
        //     // exit;

        // $query->setQuery($qb);
        return $query->getResponse();

    }


    /**
     * @Route("/create", name="eventregistration_create")
     * @param Request $request
     * @param EventRegistrationFlow $flow
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param \Swift_Mailer $mailer
     * @return RedirectResponse|Response
     */
    public function createAction(Request $request, EventRegistrationFlow $flow, UserPasswordEncoderInterface $passwordEncoder, \Swift_Mailer $mailer)
    {
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
                    $em = $this->getDoctrine()->getManager();
                    $userRepository = $em->getRepository(User::class);

                    $user = $userRepository->findOneBy(['email'=>$entity->getEmail()]);
                    $plainpass = null;

                    if (!$user) {
                        $plainpass = $this->generatePassword();
                        $user = new User;
                        $user->setEmail($entity->getEmail());
                        $user->setPassword($passwordEncoder->encodePassword(
                            $user,
                            $plainpass
                        ));
                        $user->setRoles(['ROLE_USER']);
                    }


                    $entity->setUser($user);
                    $entity->setCreated(new \DateTime);
                    
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
                            )), 'text/html'
                        );

                    $mailer->send($message);


                    $message = (new \Swift_Message('Regisztráció visszaigazolása - Magyar Klipszemle nevezés'))
                        ->setFrom(['info@klipszemle.com' => "Magyar Klipszemle"])
                        ->setTo(array('info.klipszemle@gmail.com', 'olah.gergely@pixeloid.hu'))
                        ->setBody(
                            $this->renderView('EventRegistration/success-mail.html.twig', array(
                                'entity'      => $entity,
                                'plainpass' => $plainpass,
                            )), 'text/html'
                        );

                    $mailer->send($message);


                    return $this->redirect($this->generateUrl('eventregistration_success', array('id' => $entity->getId())));
                }

            }else{
                // $errors = array();

                // foreach ($form->getErrors() as $key => $error) {
                //         $errors[] = $error->getMessage();
                // }


                // var_dump($errors);
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
            $budget = $em->getRepository('App:BudgetCategory')->findOneById($reg->getBudget() + 1);
            $title = $em->getRepository('App:UserTitle')->findOneById($reg->getTitle() + 1);
            $reg->setBudgetCategory($budget);        
            $reg->setUserTitle($title);        
            foreach($reg->getCategories() as $cat){
                $category = $em->getRepository('App:MovieCategory')->findOneById($cat + 1);
                $reg->addMovieCategory($category); 
            }
            $em->persist($reg);
        }

        $em->flush();

    }


    /**
     * @Route("/registration", name="eventregistration_new")
     * @param Request $request
     * @param EventRegistrationFlow $flow
     * @return Response
     */

    public function newAction(Request $request, EventRegistrationFlow $flow)
    {
        $entity = new EventRegistration();

        $flow = $this->createCreateForm($entity, $flow);

        $form = $flow->createForm();


        $em = $this->getDoctrine()->getManager();

        


        return $this->render('EventRegistration/new_flow.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'flow'   => $flow,
        ));
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @Route("/{id}/show", name="eventregistration_show", options={"expose"=true})
     */
    public function showAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser();


        $entity = $em->getRepository('App:EventRegistration')->find($id);

        if (!$entity || $entity->getUser() !== $user && !$this->get('security.authorization_checker')->isGranted('ROLE_ADMIN')) {
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
    public function registrationSuccessAction($id)
    {
      $em = $this->getDoctrine()->getManager();

      $entity = $em->getRepository('App:EventRegistration')->findOneById($id);
        return $this->render('EventRegistration/success.html.twig', array(
          'reg' => $entity, 
        ));


    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:EventRegistration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventRegistration entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('EventRegistration/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }



    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:EventRegistration')->find($id);
        $categories = $em->getRepository('App:MovieCategory')->findAll();

        $shortlisted_categories = array();

        foreach ($entity->getMoviecategories() as $cat) {
            if ($cat->getShortlist()) {
                $shortlisted_categories[] = $cat->getCategory();
            }
        }

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventRegistration entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {

            $entity->getMovieCategories()->clear();
            foreach ($editForm->get('moviecategories')->getData() as $cat) {

                $movieCat = new EventRegistrationCategory;
                $movieCat->setCategory($cat);
                $movieCat->setEventRegistration($entity);

                foreach ($shortlisted_categories as $shortlisted) {
                    if ($shortlisted == $cat) {
                        $movieCat->setShortlist(true);
                    }
                }

                $entity->addMovieCategory($movieCat);
                
            }

                $em->flush();

            return $this->redirect($this->generateUrl('eventregistration_show', array('id' => $id)));
        }else{
            $errors = array();

            foreach ($editForm->getErrors() as $key => $error) {
                if ($editForm->isRoot()) {
                    $errors['#'][$key] = $error->getMessage();
                } else {
                    $errors[] = $error->getMessage();
                }
            }


            var_dump($editForm->getErrorsAsString());
        }

        return $this->render('EventRegistration/edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('App:EventRegistration')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find EventRegistration entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('eventregistration'));
    }

    /**
     * Creates a form to delete a EventRegistration entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('eventregistration_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }


    public function calculateAction(Request $request)
    {
        $entity = new EventRegistration();

        $em = $this->getDoctrine()->getManager();

        $flow = $this->createCreateForm($entity);
        $form = $flow->createForm();
        $form->handleRequest($request);

        return new JsonResponse(array(
            'nights' => $entity->getRoomReservation() ? $entity->getRoomReservation()->getNumDays() : 0,
            'accomodation' => $entity->getRoomReservation() ? $entity->getRoomReservation()->getTotalCost() : 0,
            'dining' =>  $entity->getDiningReservation() ? $entity->getDiningReservation()->getTotalCost() : 0,
            'registration' => $entity->getRegistrantType() ? $entity->getRegistrationFee() : 0,
            'total' => (int) $entity->getTotalCost(),
        ));
    }

    /**
    * Creates a form to edit a EventRegistration entity.
    *
    * @param EventRegistration $entity The entity
    *
    * @return Form The form
    */
    private function createEditForm(EventRegistration $entity)
    {   
        $form = $this->createForm(new EventRegistrationEditType(), $entity, array(
            'action' => $this->generateUrl('eventregistration_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $cats = array();
        foreach ($entity->getMovieCategories()  as $cat) {
            $cats[] = $cat->getCategory();
        }
        $form->get('moviecategories')->setData($cats);

        $form->add('submit', 'submit', array('label' => 'Mentés'));

        return $form;
    }

    /**
     * Creates a form to create a EventRegistration entity.
     *
     * @param EventRegistration $entity The entity
     *
     * @return Form The form
     */
    private function createCreateForm(EventRegistration $entity, EventRegistrationFlow $flow)
    {


        $flow->bind($entity);

        $flow->setGenericFormOptions(array(
            'action' => $this->generateUrl('eventregistration_create'),
            'method' => 'POST',
        ));


        return $flow;
    }

    public function addToShortlistAction(Request $request, $id, $flag)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('App:EventRegistrationCategory')->find($id);
        
        $entity->setShortlist($flag);
        $em->persist($entity);
        $em->flush();

        $referer = $request->headers->get('referer');
        return new RedirectResponse($referer);

    }

    private function generatePassword($length = 8) {
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        $count = mb_strlen($chars);

        for ($i = 0, $result = ''; $i < $length; $i++) {
            $index = rand(0, $count - 1);
            $result .= mb_substr($chars, $index, 1);
        }

        return $result;
    }
}
