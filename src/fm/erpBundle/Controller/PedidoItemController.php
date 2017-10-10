<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\PedidoItem;
use fm\erpBundle\Form\PedidoItemType;

/**
 * PedidoItem controller.
 *
 * @Route("/pedidoitem")
 */
class PedidoItemController extends Controller
{

    /**
     * Creates a new PedidoItem entity.
     *
     * @Route("/", name="pedidoitem_create")
     * @Method("POST")
     * @Template("erpBundle:PedidoItem:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new PedidoItem();
        $entity->setFechaInclusion(new \DateTime());
        $entity->setCantidad(1);
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
        }
        return $this->redirect($this->generateUrl('pedido_select_facturas',['id'=>$entity->getPedido()->getId()]));
    }

    /**
     * Creates a form to create a PedidoItem entity.
     *
     * @param PedidoItem $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(PedidoItem $entity)
    {
        $form = $this->createForm(new PedidoItemType(), $entity, array(
            'action' => $this->generateUrl('pedidoitem_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Añadir'));

        return $form;
    }

    /**
     * Displays a form to create a new PedidoItem entity.
     *
     * @Route("{idPedido}/factura/{idFactura}/new", name="pedidoitem_factura_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($idPedido,$idFactura)
    {

        $em = $this->getDoctrine()->getManager();
        $facturaEntity = $em->getRepository('erpBundle:factura')->find($idFactura);
        $pedidoEntity = $em->getRepository('erpBundle:Pedido')->find($idPedido);
        if (!$facturaEntity) {
            throw $this->createNotFoundException('Unable to find factura entity.');
        }
        if (!$pedidoEntity) {
            throw $this->createNotFoundException('Unable to find pedido entity.');
        }

        $strings = [];       
        foreach($facturaEntity->getMisItems() as $item){
             $strings[] = $item->getDescripcion();
        }

        $entity = new PedidoItem();
        $entity->setPedido($pedidoEntity);
        $entity->setFactura($facturaEntity);
        $entity->setCarpintero(implode(' + ',$strings));

        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'factura' => $facturaEntity,
            'pedido' => $pedidoEntity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a PedidoItem entity.
     *
     * @Route("/{id}", name="pedidoitem_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:PedidoItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

   /**
     * Finds and displays a PedidoItem entity.
     * @Template()
     */
     public function deleteButtonAction($id)
     {
         $em = $this->getDoctrine()->getManager();
 
         $deleteForm = $this->createDeleteForm($id);
 
         return array(
             'delete_form' => $deleteForm->createView(),
         );
     }



    /**
     * Displays a form to edit an existing PedidoItem entity.
     *
     * @Route("/{id}/edit", name="pedidoitem_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:PedidoItem')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoItem entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView()
        );
    }

    /**
    * Creates a form to edit a PedidoItem entity.
    *
    * @param PedidoItem $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(PedidoItem $entity)
    {
        $form = $this->createForm(new PedidoItemType(), $entity, array(
            'action' => $this->generateUrl('pedidoitem_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing PedidoItem entity.
     *
     * @Route("/{id}", name="pedidoitem_update")
     * @Method("PUT")
     * @Template("erpBundle:PedidoItem:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:PedidoItem')->find($id);
        $pedido = $entity->getPedido();
        
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find PedidoItem entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pedido_select_facturas',['id'=>$pedido->getId()]));
        

   
    }
    /**
     * Deletes a PedidoItem entity.
     *
     * @Route("/{id}", name="pedidoitem_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:PedidoItem')->find($id);
            $pedido = $entity->getPedido();
            if (!$entity) {
                throw $this->createNotFoundException('Unable to find PedidoItem entity.');
            }

            $em->remove($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('pedido_select_facturas',['id'=>$pedido->getId()]));
            
        }

        return $this->redirect($this->generateUrl('pedido'));
    }

    /**
     * Creates a form to delete a PedidoItem entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pedidoitem_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Retirar del pedido'))
            ->getForm()
        ;
    }
}
