<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\proveedoresfacturas;
use fm\erpBundle\Form\proveedoresfacturasType;

/**
 * proveedoresfacturas controller.
 *
 * @Route("/proveedoresfacturas")
 */
class proveedoresfacturasController extends Controller
{

    /**
     * Lists all proveedoresfacturas entities.
     *
     * @Route("/", name="proveedoresfacturas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:proveedoresfacturas')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new proveedoresfacturas entity.
     *
     * @Route("/", name="proveedoresfacturas_create")
     * @Method("POST")
     * @Template("erpBundle:proveedoresfacturas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new proveedoresfacturas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proveedoresfacturas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a proveedoresfacturas entity.
    *
    * @param proveedoresfacturas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(proveedoresfacturas $entity)
    {
        $form = $this->createForm(new proveedoresfacturasType(), $entity, array(
            'action' => $this->generateUrl('proveedoresfacturas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new proveedoresfacturas entity.
     *
     * @Route("/new", name="proveedoresfacturas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new proveedoresfacturas();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a proveedoresfacturas entity.
     *
     * @Route("/{id}", name="proveedoresfacturas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:proveedoresfacturas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proveedoresfacturas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing proveedoresfacturas entity.
     *
     * @Route("/{id}/edit", name="proveedoresfacturas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:proveedoresfacturas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proveedoresfacturas entity.');
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
    * Creates a form to edit a proveedoresfacturas entity.
    *
    * @param proveedoresfacturas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(proveedoresfacturas $entity)
    {
        $form = $this->createForm(new proveedoresfacturasType(), $entity, array(
            'action' => $this->generateUrl('proveedoresfacturas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing proveedoresfacturas entity.
     *
     * @Route("/{id}", name="proveedoresfacturas_update")
     * @Method("PUT")
     * @Template("erpBundle:proveedoresfacturas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:proveedoresfacturas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proveedoresfacturas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('proveedoresfacturas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a proveedoresfacturas entity.
     *
     * @Route("/{id}", name="proveedoresfacturas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:proveedoresfacturas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find proveedoresfacturas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proveedoresfacturas'));
    }

    /**
     * Creates a form to delete a proveedoresfacturas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('proveedoresfacturas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
