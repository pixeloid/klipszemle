<?php

namespace Pixeloid\AppBundle\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;


use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

use Pixeloid\AppBundle\Entity\Presentation;
use Pixeloid\AppBundle\Form\PresentationType;

/**
 * Presentation controller.
 */
class PresentationController extends Controller
{

    /**
     * Lists all Presentation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PixeloidAppBundle:Presentation')->findAll();

        return $this->render('PixeloidAppBundle:Presentation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Presentation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Presentation();

        $flow = $this->createCreateForm($entity);

        $form = $flow->createForm();

        if ($flow->isValid($form)) {
            
            $flow->saveCurrentStepData($form);

            if ($flow->nextStep()) {
                // form for the next step
                $form = $flow->createForm();
            } else {
                // flow finished
                $em = $this->getDoctrine()->getManager();
                $em->persist($entity);
                $em->flush();

                $flow->reset(); // remove step data from the session



                $html = $this->renderView('PixeloidAppBundle:Presentation:presentation.html.twig', array(
                    'entity'      => $entity,
                ));
                $pdfGenerator = $this->get('spraed.pdf.generator');

                $pdf = null; //$pdfGenerator->generatePDF($html);

                $attachment = \Swift_Attachment::newInstance()
                  ->setFilename('mmtt2015_absztrakt_'.$entity->getId().'.pdf')
                  ->setContentType('application/pdf')
                  ->setBody($pdf)
                  ;

                $message = \Swift_Message::newInstance()
                    ->setSubject('Absztrakt feltöltés visszaigazolása - Magyar Gyermek-gasztroenterológiai Társaság V. Kongresszusa')
                    ->setFrom('noreply@misandbos.hu')
                    ->setTo(array($entity->getEmail(), 'mgygt2015@misandbos.hu', 'olah.gergely@pixeloid.hu'))
                    ->setBody(
                        $this->renderView('PixeloidAppBundle:Presentation:success-mail.html.twig', array(
                            'entity'      => $entity,
                        )), 'text/html'
                    )
                    ->attach($attachment);

                $this->get('mailer')->send($message);



                return $this->redirect($this->generateUrl('presentation_show', array('id' => $entity->getId())));
            }

        }else{
            // var_dump(($form->getErrorsAsString()));
        }

        return $this->render('PixeloidAppBundle:Presentation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'flow'   => $flow,

        ));
    }

    /**
     * Creates a form to create a Presentation entity.
     *
     * @param Presentation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Presentation $entity)
    {

           $flow = $this->get('pixeloid_app.flow.presentation'); // must match the flow's service id
           $flow->bind($entity);


          // $reservation = new AccomodationReservation;
        //   $entity->setReservation($reservation);


           $flow->setGenericFormOptions(array(
               'action' => $this->generateUrl('presentation_create'),
               'method' => 'POST',
           ));


           return $flow;

    }

    /**
     * Displays a form to create a new Presentation entity.
     *
     */
    public function newAction()
    {
        $entity = new Presentation();
        
        $flow = $this->createCreateForm($entity);

        $form = $flow->createForm();

        return $this->render('PixeloidAppBundle:Presentation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
            'flow'   => $flow,
        ));
    }

    /**
     * Finds and displays a Presentation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:Presentation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Presentation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);





        return $this->render('PixeloidAppBundle:Presentation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Presentation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:Presentation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Presentation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PixeloidAppBundle:Presentation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Presentation entity.
    *
    * @param Presentation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Presentation $entity)
    {
        $form = $this->createForm(new PresentationType(), $entity, array(
            'action' => $this->generateUrl('presentation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Presentation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:Presentation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Presentation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('presentation_edit', array('id' => $id)));
        }

        return $this->render('PixeloidAppBundle:Presentation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Presentation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PixeloidAppBundle:Presentation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Presentation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('presentation'));
    }

    /**
     * Creates a form to delete a Presentation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('presentation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
