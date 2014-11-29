<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\series;
use fm\erpBundle\Form\seriesType;

/**
 * series controller.
 *
 * @Route("/series")
 */
class seriesController extends Controller
{

    /**
     * Lists all series entities.
     *
     * @Route("/", name="series")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:series')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new series entity.
     *
     * @Route("/", name="series_create")
     * @Method("POST")
     * @Template("erpBundle:series:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new series();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('series_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a series entity.
    *
    * @param series $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(series $entity)
    {
        $form = $this->createForm(new seriesType(), $entity, array(
            'action' => $this->generateUrl('series_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new series entity.
     *
     * @Route("/new", name="series_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new series();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a series entity.
     *
     * @Route("/{id}", name="series_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:series')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find series entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing series entity.
     *
     * @Route("/{id}/edit", name="series_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:series')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find series entity.');
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
    * Creates a form to edit a series entity.
    *
    * @param series $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(series $entity)
    {
        $form = $this->createForm(new seriesType(), $entity, array(
            'action' => $this->generateUrl('series_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing series entity.
     *
     * @Route("/{id}", name="series_update")
     * @Method("PUT")
     * @Template("erpBundle:series:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:series')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find series entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('series_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a series entity.
     *
     * @Route("/{id}", name="series_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:series')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find series entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('series'));
    }

    /**
     * Creates a form to delete a series entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('series_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
