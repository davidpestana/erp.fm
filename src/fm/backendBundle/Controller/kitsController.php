<?php

namespace fm\backendBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\KitBundle\Entity\kits;
use fm\KitBundle\Form\kitsType;

/**
 * kits controller.
 *
 * @Route("/kits")
 */
class kitsController extends Controller
{

    /**
     * Lists all kits entities.
     *
     * @Route("/", name="kits")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KitBundle:kits')->findAll();
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new kits entity.
     *
     * @Route("/", name="kits_create")
     * @Method("POST")
     * @Template("KitBundle:kits:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new kits();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('kits_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a kits entity.
     *
     * @param kits $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(kits $entity)
    {
        $form = $this->createForm(new kitsType(), $entity, array(
            'action' => $this->generateUrl('kits_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new kits entity.
     *
     * @Route("/new", name="kits_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new kits();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a kits entity.
     *
     * @Route("/{id}", name="kits_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KitBundle:kits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find kits entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing kits entity.
     *
     * @Route("/{id}/edit", name="kits_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KitBundle:kits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find kits entity.');
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
    * Creates a form to edit a kits entity.
    *
    * @param kits $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(kits $entity)
    {
        $form = $this->createForm(new kitsType(), $entity, array(
            'action' => $this->generateUrl('kits_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing kits entity.
     *
     * @Route("/{id}", name="kits_update")
     * @Method("PUT")
     * @Template("KitBundle:kits:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KitBundle:kits')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find kits entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('kits_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a kits entity.
     *
     * @Route("/{id}", name="kits_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('KitBundle:kits')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find kits entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('kits'));
    }

    /**
     * Creates a form to delete a kits entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kits_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
