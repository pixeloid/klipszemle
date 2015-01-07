<?php

namespace Pixeloid\AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Pixeloid\AppBundle\Entity\Accomodation;
use Pixeloid\AppBundle\Form\AccomodationType;

/**
 * Accomodation controller.
 *
 */
class AccomodationController extends Controller
{

    /**
     * Lists all Accomodation entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('PixeloidAppBundle:Accomodation')->findAll();

        return $this->render('PixeloidAppBundle:Accomodation:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Accomodation entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Accomodation();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('accomodation_show', array('id' => $entity->getId())));
        }

        return $this->render('PixeloidAppBundle:Accomodation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Accomodation entity.
     *
     * @param Accomodation $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Accomodation $entity)
    {
        $form = $this->createForm(new AccomodationType(), $entity, array(
            'action' => $this->generateUrl('accomodation_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Accomodation entity.
     *
     */
    public function newAction()
    {
        $entity = new Accomodation();
        $form   = $this->createCreateForm($entity);

        return $this->render('PixeloidAppBundle:Accomodation:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Accomodation entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:Accomodation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accomodation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PixeloidAppBundle:Accomodation:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Accomodation entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:Accomodation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accomodation entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('PixeloidAppBundle:Accomodation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Accomodation entity.
    *
    * @param Accomodation $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Accomodation $entity)
    {
        $form = $this->createForm(new AccomodationType(), $entity, array(
            'action' => $this->generateUrl('accomodation_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Accomodation entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('PixeloidAppBundle:Accomodation')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Accomodation entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('accomodation_edit', array('id' => $id)));
        }

        return $this->render('PixeloidAppBundle:Accomodation:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Accomodation entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('PixeloidAppBundle:Accomodation')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Accomodation entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('accomodation'));
    }

    /**
     * Creates a form to delete a Accomodation entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('accomodation_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
