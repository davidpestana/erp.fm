<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\proformas;
use fm\erpBundle\Form\proformasType;
use Ps\PdfBundle\Annotation\Pdf;

/**
 * proformas controller.
 *
 * @Route("/proformas")
 */
class proformasController extends Controller
{

    /**
     * Lists all proformas entities.
     *
     * @Route("/", name="proformas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:proformas')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new proformas entity.
     *
     * @Route("/", name="proformas_create")
     * @Method("POST")
     * @Template("erpBundle:proformas:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new proformas();
        $form = $this->createForm(new proformasType(), $entity);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proformas', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new proformas entity.
     *
     * @Route("/new/{cliente}", name="proformas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(\fm\erpBundle\Entity\clientes $cliente = null)
    {
        $entity = new proformas();
        $entity->setCliente($cliente);
        $entity->setCodproforma("FM0003-2013");
        $entity->setFecha( new \DateTime() );
        $form   = $this->createForm(new proformasType(), $entity);
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a proformas entity.
     *
     * @Pdf()
     * @Route("/{id}", name="proformas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:proformas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proformas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }



    /**
     * Displays a form to edit an existing proformas entity.
     *
     * @Route("/{id}/edit", name="proformas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:proformas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proformas entity.');
        }

        $editForm = $this->createForm(new proformasType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing proformas entity.
     *
     * @Route("/{id}", name="proformas_update")
     * @Method("PUT")
     * @Template("erpBundle:proformas:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:proformas')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find proformas entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new proformasType(), $entity);
        $editForm->submit($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('proformas', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a proformas entity.
     *
     * @Route("/{id}", name="proformas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->submit($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:proformas')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find proformas entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('proformas'));
    }

    /**
     * Creates a form to delete a proformas entity by id.
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
