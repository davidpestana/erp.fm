<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\clientes;
use fm\erpBundle\Form\clientesType;

/**
 * clientes controller.
 *
 * @Route("/clientes")
 */
class clientesController extends Controller
{

    /**
     * Lists all clientes entities.
     *
     * @Route("/", name="clientes")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $limit = $request->get('limit');
        $offset = $request->get('offset');

        $limit = $limit ? $limit : 100;


       // $entities = $em->getRepository('erpBundle:clientes')->findAll();
        $entities = $em->getRepository('erpBundle:clientes')->findBy(array(), array('id' => 'ASC'),$limit);
        $conceptosunicos = $em->getRepository('erpBundle:conceptounico')->findAll();

        return array(
            'entities' => $entities,
            'conceptosunicos' => $conceptosunicos
        );
    }


    /**
     * Creates a new clientes entity.
     *
     * @Route("/", name="clientes_create")
     * @Method("POST")
     * @Template("erpBundle:clientes:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new clientes();
        $form = $this->createForm(new clientesType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clientes', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new clientes entity.
     *
     * @Route("/new", name="clientes_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new clientes();
        $form   = $this->createForm(new clientesType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a clientes entity.
     *
     * @Route("/{id}", name="clientes_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:clientes')->find($id);

        

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find clientes entity.');
        }

        $proformas = $entity->getProformas();
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'proformas'   => $proformas,
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing clientes entity.
     *
     * @Route("/{id}/edit", name="clientes_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:clientes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find clientes entity.');
        }

        $editForm = $this->createForm(new clientesType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing clientes entity.
     *
     * @Route("/{id}", name="clientes_update")
     * @Method("PUT")
     * @Template("erpBundle:clientes:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:clientes')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find clientes entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new clientesType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clientes'));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a clientes entity.
     *
     * @Route("/{id}", name="clientes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:clientes')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find clientes entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('clientes'));
    }

    /**
     * Creates a form to delete a clientes entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
