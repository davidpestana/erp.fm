<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\DireccionEnvio;
use fm\erpBundle\Form\DireccionEnvioType;

/**
 * DireccionEnvio controller.
 *
 * @Route("/direccionenvio")
 */
class DireccionEnvioController extends Controller
{

    /**
     * Lists all DireccionEnvio entities.
     *
     * @Route("/", name="direccionenvio")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:DireccionEnvio')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new DireccionEnvio entity.
     *
     * @Route("/", name="direccionenvio_create")
     * @Method("POST")
     * @Template("erpBundle:DireccionEnvio:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new DireccionEnvio();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('clientes'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a DireccionEnvio entity.
     *
     * @param DireccionEnvio $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(DireccionEnvio $entity)
    {
        $form = $this->createForm(new DireccionEnvioType(), $entity, array(
            'action' => $this->generateUrl('direccionenvio_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new DireccionEnvio entity.
     *
     * @Route("/new/{cliente}", name="direccionenvio_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(\fm\erpBundle\Entity\clientes $cliente = null)
    {
        $entity = new DireccionEnvio();
        $entity->setCliente($cliente);

        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a DireccionEnvio entity.
     *
     * @Route("/{id}", name="direccionenvio_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:DireccionEnvio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DireccionEnvio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing DireccionEnvio entity.
     *
     * @Route("/{id}/edit", name="direccionenvio_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:DireccionEnvio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DireccionEnvio entity.');
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
    * Creates a form to edit a DireccionEnvio entity.
    *
    * @param DireccionEnvio $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(DireccionEnvio $entity)
    {
        $form = $this->createForm(new DireccionEnvioType(), $entity, array(
            'action' => $this->generateUrl('direccionenvio_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing DireccionEnvio entity.
     *
     * @Route("/{id}", name="direccionenvio_update")
     * @Method("PUT")
     * @Template("erpBundle:DireccionEnvio:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:DireccionEnvio')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find DireccionEnvio entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
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
     * Deletes a DireccionEnvio entity.
     *
     * @Route("/{id}", name="direccionenvio_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:DireccionEnvio')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find DireccionEnvio entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('clientes'));
    }

    /**
     * Creates a form to delete a DireccionEnvio entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('direccionenvio_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
