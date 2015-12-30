<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\conceptounico;
use fm\erpBundle\Form\conceptounicoType;

/**
 * conceptounico controller.
 *
 * @Route("/conceptounico")
 */
class conceptounicoController extends Controller
{

    /**
     * Lists all conceptounico entities.
     *
     * @Route("/", name="conceptounico")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:conceptounico')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new conceptounico entity.
     *
     * @Route("/", name="conceptounico_create")
     * @Method("POST")
     * @Template("erpBundle:conceptounico:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new conceptounico();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('conceptounico_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a conceptounico entity.
     *
     * @param conceptounico $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(conceptounico $entity)
    {
        $form = $this->createForm(new conceptounicoType(), $entity, array(
            'action' => $this->generateUrl('conceptounico_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new conceptounico entity.
     *
     * @Route("/new", name="conceptounico_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new conceptounico();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a conceptounico entity.
     *
     * @Route("/{id}", name="conceptounico_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:conceptounico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find conceptounico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing conceptounico entity.
     *
     * @Route("/{id}/edit", name="conceptounico_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:conceptounico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find conceptounico entity.');
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
    * Creates a form to edit a conceptounico entity.
    *
    * @param conceptounico $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(conceptounico $entity)
    {
        $form = $this->createForm(new conceptounicoType(), $entity, array(
            'action' => $this->generateUrl('conceptounico_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing conceptounico entity.
     *
     * @Route("/{id}", name="conceptounico_update")
     * @Method("PUT")
     * @Template("erpBundle:conceptounico:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:conceptounico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find conceptounico entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('conceptounico_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a conceptounico entity.
     *
     * @Route("/{id}", name="conceptounico_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:conceptounico')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find conceptounico entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('conceptounico'));
    }

    /**
     * Creates a form to delete a conceptounico entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('conceptounico_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
