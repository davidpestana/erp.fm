<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\Pedido;
use fm\erpBundle\Entity\PedidoItem;
use fm\erpBundle\Form\PedidoType;
use fm\erpBundle\Form\PedidoItemsCollectionType;
use Ps\PdfBundle\Annotation\Pdf;

/**
 * Pedido controller.
 *
 * @Route("/pedido")
 */
class PedidoController extends Controller
{

    /**
     * Lists all Pedido entities.
     *
     * @Route("/", name="pedido")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:Pedido')->findAll();

        return array(
            'entities' => $entities,
        );
    }


    /**
     * Select no enviados Pedido entities.
     *
     * @Method("GET")
     * @Template()
     */
     public function selectAction()
     {
         $em = $this->getDoctrine()->getManager();

         $filter = ['fechaEnvio' => null];
         $order  = ['id' => 'DESC'];
         $entities = $em->getRepository('erpBundle:Pedido')->findBy($filter,$order);

         return array(
             'entities' => $entities,
         );
     }

    /**
     * add items to pedido entity.
     *
     * @Route("/{id}/selectFacturas", name="pedido_select_facturas")
     * @Method("GET")
     * @Template()
     */
     
     public function selectFacturasAction($id)
     {
         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('erpBundle:Pedido')->find($id);
         $facturas = $em->getRepository('erpBundle:factura')->findby(
                        array("estado" => 2), 
                        array('id' => 'DESC')
                    );
         if (!$entity) {
             throw $this->createNotFoundException('Unable to find Pedido entity.');
         }

         return array('entity'=>$entity,'facturas'=>$facturas);
          
     }


    // /**
    //  * add items to pedido entity.
    //  *
    //  * @Route("/{id}/addItems", name="pedido_add_items")
    //  * @Method("PUT")
    //  */
     
    //  public function addItemsAction(Request $request, $id)
    //  {
    //      $em = $this->getDoctrine()->getManager();
    //      $entity = $em->getRepository('erpBundle:Pedido')->find($id);

    //      if (!$entity) {
    //          throw $this->createNotFoundException('Unable to find Pedido entity.');
    //      }
    //      $newItems = $request->request->get('fm_erpbundle_pedido')['items'];

    //      foreach($newItems as $item){
    //          $itemInstance = new PedidoItem();
    //          $itemInstance->setCantidad($item['cantidad']);
    //          $itemInstance->setDescripcion($item['descripcion']);
    //          $itemInstance->setObservaciones($item['observaciones']);
    //          $itemInstance->setProveedor($item['proveedor']);
    //          $itemInstance->setFactura($em->getRepository('erpBundle:factura')->find($item['factura']));
             
    //          $entity->addItem($itemInstance);
    //         // $em->persist($itemInstance);
    //      }

    //     //  $form = $this->createForm(new PedidoItemsCollectionType(), $entity);
    //     //  //$form = $this->createEditForm($entity);
         
    //     //  $form->handleRequest($request);
    //     //  /*add previous after new added*/
    //     //   $items = $entity->getItems()->toArray();
    //     //   foreach($items as $item) {
    //     //         $item->flushId();  // for new insert
    //     //         ldd($item);
    //     //         $em->persist($item);
    //     //  }
    //      $em->persist($entity);
    //      $em->flush();
         
    //      return $this->redirect($this->generateUrl('pedido_select_facturas',['id'=>$entity->getId()]));
          
    //  }


    /**
     * Creates a new Pedido entity.
     *
     * @Route("/", name="pedido_create")
     * @Method("POST")
     * @Template("erpBundle:Pedido:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Pedido();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
return $this->redirect($this->generateUrl('pedido',[]));
           // return $this->redirect($this->generateUrl('pedido_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    // /**
    //  * Creates a new Pedido entity.
    //  *
    //  * @Route("/create/ajax", name="pedido_create_ajax")
    //  * @Method("POST")
    //  */
    //  public function createAjaxAction()
    //  {
    //     $entity = new Pedido();
    //     $em = $this->getDoctrine()->getManager();
    //     $em->persist($entity);
    //     $em->flush();
    //     return  new JsonResponse(['message'=>'Pedido creado','fechaCreacion'=>$entity->getFechaCreacion(),'id'=>$entity->getId()]);
    //  }



    /**
     * Creates a form to create a Pedido entity.
     *
     * @param Pedido $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Pedido $entity)
    {
        $form = $this->createForm(new PedidoType(), $entity, array(
            'action' => $this->generateUrl('pedido_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear Nuevo Pedido'));

        return $form;
    }

    /**
     * Displays a form to create a new Pedido entity.
     *
     * @Route("/new", name="pedido_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Pedido();
        $entity->setFechaEntrega(new \DateTime());
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Pedido entity.
     *
     * @Pdf()
     * @Route("/{id}", name="pedido_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id,Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:Pedido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pedido entity.');
        }

        return array(
            'entity'      => $entity,
            'proveedor'   => $request->get('proveedor')
        );
    }


    /**
     *
     * @Route("/{id}/send", name="pedido_send")
     * @Method("GET")
     * @Template()
     */
     public function sendAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('erpBundle:Pedido')->find($id);
        $entity->tramitar();
        $em->persist($entity);
        $em->flush();
        $data = $this->forward('erpBundle:pedido:show', 
           array( 'id' => $id, '_format' => 'pdf','proveedor' => 'masferrer'));


       $message = \Swift_Message::newInstance()
           ->setSubject(' FURGOMANIA ALBARAN Nº: '.$entity->getId())
           ->setFrom('contacto@furgomania.com')
           ->setTo('solchitos@gmail.com')
          // ->setCc(array('info@furgomania.com', 'ventas@furgomania.com','tecnicom@quimp.es'))
           ->setBody(
               $this->renderView(
                   'erpBundle:Pedido:email.html.twig',
                   array( 'entity'=> $entity)
               ), 'text/html'
           )
           ->attach(\Swift_Attachment::newInstance()
                 ->setFilename('masferrer_'.$entity->getId().'.pdf')
                 ->setContentType('application/pdf')
                 ->setBody($data))

    
       ;

       $this->get('mailer')->send($message);
       return $this->redirect($this->generateUrl('pedido',[]));
       
   }


    /**
     * Displays a form to edit an existing Pedido entity.
     *
     * @Route("/{id}/edit", name="pedido_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:Pedido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pedido entity.');
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
    * Creates a form to edit a Pedido entity.
    *
    * @param Pedido $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Pedido $entity)
    {
        $form = $this->createForm(new PedidoType(), $entity, array(
            'action' => $this->generateUrl('pedido_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Guardar los cambios'));

        return $form;
    }
    /**
     * Edits an existing Pedido entity.
     *
     * @Route("/{id}", name="pedido_update")
     * @Method("PUT")
     * @Template("erpBundle:Pedido:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:Pedido')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Pedido entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();
return $this->redirect($this->generateUrl('pedido',[]));

          //  return $this->redirect($this->generateUrl('pedido_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Pedido entity.
     *
     * @Route("/{id}", name="pedido_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:Pedido')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Pedido entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('pedido'));
    }

    /**
     * Creates a form to delete a Pedido entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('pedido_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar este pedido'))
            ->getForm()
        ;
    }
}
