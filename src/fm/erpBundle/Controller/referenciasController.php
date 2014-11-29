<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\referencias;
use fm\erpBundle\Form\referenciasType;

/**
 * referencias controller.
 *
 * @Route("/referencias")
 */
class referenciasController extends Controller
{

    /**
     * Lists all referencias entities.
     *
     * @Route("/", name="referencias")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:referencias')->findAll();

        return array(
            'entities' => $entities,
        );
    }

    /**
     * Lists all referencias entities.
     *
     * @Template()
     */
    public function listadoAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:referencias')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new referencias entity.
     *
     * @Route("/", name="referencias_create")
     * @Method("POST")
     * @Template("erpBundle:referencias:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new referencias();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('referencias', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a referencias entity.
    *
    * @param referencias $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(referencias $entity)
    {
        $form = $this->createForm(new referenciasType(), $entity, array(
            'action' => $this->generateUrl('referencias_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new referencias entity.
     *
     * @Route("/new", name="referencias_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new referencias();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a referencias entity.
     *
     * @Route("/{id}", name="referencias_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:referencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find referencias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing referencias entity.
     *
     * @Route("/{id}/edit", name="referencias_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:referencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find referencias entity.');
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
    * Creates a form to edit a referencias entity.
    *
    * @param referencias $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(referencias $entity)
    {
        $form = $this->createForm(new referenciasType(), $entity, array(
            'action' => $this->generateUrl('referencias_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing referencias entity.
     *
     * @Route("/{id}", name="referencias_update")
     * @Method("PUT")
     * @Template("erpBundle:referencias:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:referencias')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find referencias entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('referencias', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a referencias entity.
     *
     * @Route("/{id}", name="referencias_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:referencias')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find referencias entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('referencias'));
    }

    /**
     * Creates a form to delete a referencias entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('referencias_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
