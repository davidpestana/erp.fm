<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\direcciones;
use fm\erpBundle\Form\direccionesType;

/**
 * direcciones controller.
 *
 * @Route("/direcciones")
 */
class direccionesController extends Controller
{

    /**
     * Lists all direcciones entities.
     *
     * @Route("/", name="direcciones")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:direcciones')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new direcciones entity.
     *
     * @Route("/", name="direcciones_create")
     * @Method("POST")
     * @Template("erpBundle:direcciones:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new direcciones();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('direcciones_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a direcciones entity.
     *
     * @param direcciones $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(direcciones $entity)
    {
        $form = $this->createForm(new direccionesType(), $entity, array(
            'action' => $this->generateUrl('direcciones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new direcciones entity.
     *
     * @Route("/new", name="direcciones_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new direcciones();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a direcciones entity.
     *
     * @Route("/{id}", name="direcciones_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:direcciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find direcciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing direcciones entity.
     *
     * @Route("/{id}/edit", name="direcciones_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:direcciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find direcciones entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a direcciones entity.
    *
    * @param direcciones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(direcciones $entity)
    {
        $form = $this->createForm(new direccionesType(), $entity, array(
            'action' => $this->generateUrl('direcciones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing direcciones entity.
     *
     * @Route("/{id}", name="direcciones_update")
     * @Method("PUT")
     * @Template("erpBundle:direcciones:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:direcciones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find direcciones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('direcciones_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a direcciones entity.
     *
     * @Route("/{id}", name="direcciones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:direcciones')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find direcciones entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('direcciones'));
    }

    /**
     * Creates a form to delete a direcciones entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('direcciones_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
