<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pixeloid\AppBundle\Entity\AccomodationReservation;
use Pixeloid\AppBundle\Entity\EventRegistration;
use Pixeloid\AppBundle\Form\EventRegistrationType;

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
        $accomodations = $em->getRepository('PixeloidAppBundle:Accomodation')->findAll();


        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        if ($form->isValid()) {
            
            $userManager = $this->get('fos_user.user_manager');
            $em = $this->getDoctrine()->getManager();

            $user = $userManager->findUserByEmail($entity->getEmail());

            if (!$user) {
                $user = $userManager->createUser();
                $user->setEmail($entity->getEmail());
                $user->setUsername($entity->getEmail());
                $user->setPassword($this->generatePassword());
            }

            $entity->setUser($user);
            $em->persist($user);

            if ($entity->getReservation()->getAccomodation()) {
                $entity->getReservation()->setEventRegistration($entity);
            }else{
                $entity->setReservation(null);
            }

            $em->persist($entity);
            $em->flush();



            return $this->redirect($this->generateUrl('eventregistration_success', array('id' => $entity->getId())));
        }

        return $this->render('PixeloidAppBundle:EventRegistration:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'accomodations' => $accomodations

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
        $em = $this->getDoctrine()->getManager();


       // $reservation = new AccomodationReservation;
     //   $entity->setReservation($reservation);

        $form = $this->createForm(new EventRegistrationType(), $entity, array(
            'action' => $this->generateUrl('eventregistration_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Confirm registration'));

        return $form;
    }

    /**
     * Displays a form to create a new EventRegistration entity.
     */
    public function newAction()
    {
        $entity = new EventRegistration();
        $form   = $this->createCreateForm($entity);

        $em = $this->getDoctrine()->getManager();

        $accomodations = $em->getRepository('PixeloidAppBundle:Accomodation')->findAll();


        return $this->render('PixeloidAppBundle:EventRegistration:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
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

        $entity = $em->getRepository('PixeloidAppBundle:EventRegistration')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find EventRegistration entity.');
        }


        $message = \Swift_Message::newInstance()
            ->setSubject('Registration confirmation – European Society of Paediatric Clinical Research – 24th Meeting')
            ->setFrom('noreply@misandbos.hu')
            ->setTo(array('info@misandbos.hu', 'olah.gergely@pixeloid.hu'))
            ->setBody(
                $this->renderView('PixeloidAppBundle:EventRegistration:success-mail.html.twig', array(
                    'entity'      => $entity,
                )), 'text/html'
            );

        $this->get('mailer')->send($message);


        $userManager = $this->get('fos_user.user_manager');

        $user = $userManager->findUserByEmail($entity->getUser()->getEmail());
        $token = new UsernamePasswordToken($user, $user->getPassword(), "public", $user->getRoles());
        $this->get("security.context")->setToken($token);


        return $this->render('PixeloidAppBundle:EventRegistration:success.html.twig', array(
            'entity'      => $entity,
        ));
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
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        return new JsonResponse(array(
            'total' => (int) $entity->getReservation()->getTotalCost(),
            'nights' => (int) $entity->getReservation()->getNumDays()
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
