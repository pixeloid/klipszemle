<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

use Pixeloid\AppBundle\Entity\AccomodationReservation;
use Pixeloid\AppBundle\Entity\EventRegistration;
use Pixeloid\AppBundle\Form\EventRegistrationType;
use Pixeloid\AppBundle\Entity\RoomReservation;

use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

/**
 * EventRegistration controller.
 */
class EventRegistrationController extends Controller
{

    /**
     * Lists all EventRegistration entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PixeloidAppBundle:EventRegistration')->findAll();

        return $this->render('PixeloidAppBundle:EventRegistration:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new EventRegistration entity.
     */
    public function createAction(Request $request)
    {
        $entity = new EventRegistration();
        $em = $this->getDoctrine()->getManager();

        $event = $em->getRepository('PixeloidAppBundle:Event')->findOneById(2);
        $accomodations = $em->getRepository('PixeloidAppBundle:Accomodation')->getAccomodationsByEvent(2);


        $flow = $this->createCreateForm($entity);

        $form = $flow->createForm();


        if ($flow->isValid($form)) {
            
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $userManager = $this->get('fos_user.user_manager');
                $em = $this->getDoctrine()->getManager();

                $user = $userManager->findUserByEmail($entity->getEmail());
                $plainpass = null;

                if (!$user) {
                    $plainpass = $this->generatePassword();
                    $user = $userManager->createUser();
                    $user->setEmail($entity->getEmail());
                    $user->setUsername($entity->getEmail());
                    $user->setPlainPassword($plainpass);
                }

                $entity->setUser($user);
                $em->persist($user);

                $entity->setEvent($event);
                $entity->getRoomReservation()->setEventRegistration($entity);
                $entity->getDiningReservation()->setEventRegistration($entity);

                foreach ($entity->getDiningReservation()->getDiningDates() as $date) {
                   $date->addDiningReservation($entity->getDiningReservation());                    # code...
                }
                
                $em->persist($entity);
                $em->flush();


                $flow->reset(); // remove step data from the session

                $userManager = $this->get('fos_user.user_manager');

                $user = $userManager->findUserByEmail($entity->getUser()->getEmail());
                $token = new UsernamePasswordToken($user, $user->getPassword(), "public", $user->getRoles());
                $this->get("security.context")->setToken($token);

                $message = \Swift_Message::newInstance()
                    ->setSubject('Regisztráció visszaigazolás – Magyar Gyermekaneszteziológiai és Intenzív Terápiás Társaság 2015. évi Tudományos Ülése')
                    ->setFrom('noreply@misandbos.hu')
                    ->setTo(array($entity->getUser()->getEmail(), 'info@misandbos.hu', 'olah.gergely@pixeloid.hu'))
                    ->setBody(
                        $this->renderView('PixeloidAppBundle:EventRegistration:success-mail.html.twig', array(
                            'entity'      => $entity,
                            'plainpass' => $plainpass,
                        )), 'text/html'
                    );

                $this->get('mailer')->send($message);



                return $this->redirect($this->generateUrl('eventregistration_success', array('id' => $entity->getId())));
            }

        }else{
            // var_dump(($form->getErrorsAsString()));
        }





        return $this->render('PixeloidAppBundle:EventRegistration:new_flow.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'flow'   => $flow,
            'accomodations' => $accomodations,
            'event' => $event
        ));

    }
    /**
     * Creates a form to create a EventRegistration entity.
     *
     * @param EventRegistration $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(EventRegistration $entity)
    {


        $flow = $this->get('pixeloid_app.flow.eventRegistration'); // must match the flow's service id
        $flow->bind($entity);

       // $reservation = new AccomodationReservation;
     //   $entity->setReservation($reservation);


        $flow->setGenericFormOptions(array(
            'action' => $this->generateUrl('eventregistration_create'),
            'method' => 'POST',
        ));


        return $flow;
    }

    /**
     * Displays a form to create a new EventRegistration entity.
     */
    public function newAction()
    {
        $entity = new EventRegistration();

        $flow = $this->createCreateForm($entity);

        $form = $flow->createForm();


        $em = $this->getDoctrine()->getManager();

        
        $accomodations = $em->getRepository('PixeloidAppBundle:Accomodation')->getAccomodationsByEvent(2);


        return $this->render('PixeloidAppBundle:EventRegistration:new_flow.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'flow'   => $flow,
            'accomodations' => $accomodations
        ));
    }

    /**
     * Finds and displays a EventRegistration entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:EventRegistration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventRegistration entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PixeloidAppBundle:EventRegistration:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function registrationSuccessAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $event = $em->getRepository('PixeloidAppBundle:Event')->findOneById(2);

        $entity = $em->getRepository('PixeloidAppBundle:EventRegistration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventRegistration entity.');
        }

        $page = $this->render('PixeloidAppBundle:EventRegistration:success.html.twig', array(
            'reg'      => $entity,
            'event'      => $event,
        ));


        return $page;

    }

    /**
     * Displays a form to edit an existing EventRegistration entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:EventRegistration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventRegistration entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PixeloidAppBundle:EventRegistration:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a EventRegistration entity.
    *
    * @param EventRegistration $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(EventRegistration $entity)
    {
        $form = $this->createForm(new EventRegistrationType(), $entity, array(
            'action' => $this->generateUrl('eventregistration_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing EventRegistration entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:EventRegistration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventRegistration entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('eventregistration_edit', array('id' => $id)));
        }

        return $this->render('PixeloidAppBundle:EventRegistration:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a EventRegistration entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PixeloidAppBundle:EventRegistration')->find($id);

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
     * @return \Symfony\Component\Form\Form The form
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
            'registration' => $entity->getRegistrantType() ? $entity->getRegistrantType()->getPriceBefore() : 0,
            'total' => (int) $entity->getTotalCost(),
        ));
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
