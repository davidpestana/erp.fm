<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\cajones;
use fm\erpBundle\Form\cajonesType;

/**
 * cajones controller.
 *
 * @Route("/cajones")
 */
class cajonesController extends Controller
{

    /**
     * Lists all cajones entities.
     *
     * @Route("/", name="cajones")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:cajones')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new cajones entity.
     *
     * @Route("/", name="cajones_create")
     * @Method("POST")
     * @Template("erpBundle:cajones:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new cajones();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cajones_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a cajones entity.
    *
    * @param cajones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(cajones $entity)
    {
        $form = $this->createForm(new cajonesType(), $entity, array(
            'action' => $this->generateUrl('cajones_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new cajones entity.
     *
     * @Route("/new", name="cajones_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new cajones();

        $form   = $this->createCreateForm($entity);
//        ld($form->createView()->children['_token']->vars['value']);


//var_dump( json_encode($form->createView()->children));
//die;
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a cajones entity.
     *
     * @Route("/{id}", name="cajones_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:cajones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cajones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing cajones entity.
     *
     * @Route("/{id}/edit", name="cajones_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:cajones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cajones entity.');
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
    * Creates a form to edit a cajones entity.
    *
    * @param cajones $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(cajones $entity)
    {
        $form = $this->createForm(new cajonesType(), $entity, array(
            'action' => $this->generateUrl('cajones_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing cajones entity.
     *
     * @Route("/{id}", name="cajones_update")
     * @Method("PUT")
     * @Template("erpBundle:cajones:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:cajones')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find cajones entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cajones_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a cajones entity.
     *
     * @Route("/{id}", name="cajones_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:cajones')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find cajones entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cajones'));
    }

    /**
     * Creates a form to delete a cajones entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cajones_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
