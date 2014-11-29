<?php

namespace fm\cmsBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\mainBundle\Entity\metas;
use fm\mainBundle\Form\metasType;

/**
 * metas controller.
 *
 * @Route("/metas")
 */
class metasController extends Controller
{

    /**
     * Lists all metas entities.
     *
     * @Route("/", name="cms_metas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('mainBundle:metas')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new metas entity.
     *
     * @Route("/", name="metas_create")
     * @Method("POST")
     * @Template("mainBundle:metas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new metas();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('cms_metas'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a metas entity.
     *
     * @param metas $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(metas $entity)
    {
        $form = $this->createForm(new metasType(), $entity, array(
            'action' => $this->generateUrl('metas_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new metas entity.
     *
     * @Route("/new", name="metas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new metas();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a metas entity.
     *
     * @Route("/{id}", name="metas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mainBundle:metas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find metas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing metas entity.
     *
     * @Route("/{id}/edit", name="metas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mainBundle:metas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find metas entity.');
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
    * Creates a form to edit a metas entity.
    *
    * @param metas $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(metas $entity)
    {
        $form = $this->createForm(new metasType(), $entity, array(
            'action' => $this->generateUrl('metas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing metas entity.
     *
     * @Route("/{id}", name="metas_update")
     * @Method("PUT")
     * @Template("mainBundle:metas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('mainBundle:metas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find metas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('cms_metas'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a metas entity.
     *
     * @Route("/{id}", name="metas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('mainBundle:metas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find metas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('cms_metas'));
    }

    /*
     * Creates a form to delete a metas entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('metas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
