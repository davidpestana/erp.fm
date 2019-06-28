<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\factura;
use fm\erpBundle\Entity\Pedido;
use fm\erpBundle\Entity\PedidoItem;
use fm\erpBundle\Form\PedidoItemsCollectionType;
use fm\erpBundle\Form\PedidoType;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

use fm\erpBundle\Form\facturaType;
use fm\erpBundle\Form\grabarfacturaType;
use Ps\PdfBundle\Annotation\Pdf;

use Automattic\WooCommerce\Client;




/**
 * factura controller.
 *
 * @Route("/facturas")
 */
class facturaController extends Controller
{

    /**
     * Lists all factura entities.
     *
     * @Route("/", name="factura")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {

        $limit = $request->get('limit');
        $offset = $request->get('offset');

        $limit = $limit ? $limit : 500;

        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:factura')->findby(
            array("estado" => 1),
            array('id' => 'DESC'),
            $limit
        );

        $grabadas = $em->getRepository('erpBundle:factura')->findby(
            array("estado" => 2),
            array('id' => 'DESC'),
            $limit
        );

        $conceptosunicos = $em->getRepository('erpBundle:conceptounico')->findAll();


        return array(
            'entities' => $entities,
            'grabadas' => $grabadas,
            'id_direccion' => false,
            'conceptosunicos' => $conceptosunicos
        );
    }




    /**
     * search component all factura entities.
     *
     * @Template()
     */
    public function buscadorAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:factura')->findby(
            array("estado" => 2),
            array('id' => 'DESC')
        );


        return array(
            'entities' => $entities
        );
    }

    /**
     *
     * @Route("/{id}/tooglepagado", name="factura_toogle_pagado")
     * @Method("GET")
     */
    public function tooglePagadoAction($id){
         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('erpBundle:factura')->find($id);

         if($entity->getFechaPagado() == null ){
          $estado = "atendida";
          $entity->setFechaPagado(new \DateTime());
         }else{
            $estado = "pendiente";
            $entity->setFechaPagado(null);
         }
            $em->persist($entity);
            $em->flush();

             $this->get('session')->getFlashBag()->add(
                 'notice',
                'La factura '.$entity->getCodFactura().' ha sido marcada como '.$estado.'!'
             );


            return $this->redirect($this->generateUrl('erp_homepage'));

    }


    /**
     *
     * @Route("/{id}/clone", name="factura_clone")
     * @Method("GET")
     */
    public function cloneAction($id){
         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('erpBundle:factura')->find($id);


         $new_entity = clone $entity;

         $new_entity->setSerie($em->getReference('erpBundle:series',1));


        $em->persist($new_entity);
        $em->flush();

            $this->get('session')->getFlashBag()->add(
                 'notice',
                'Se ha generado nueva factura de venta pendiente de grabar a partir de la factura '.$entity->getCodFactura()
             );


        $entity->setFechaPagado(new \DateTime());
        $em->persist($entity);
        $em->flush();

             $this->get('session')->getFlashBag()->add(
                 'notice',
                'La factura '.$entity->getCodFactura().' ha sido marcada como Atendida!'
             );


            return $this->redirect($this->generateUrl('factura'));

    }

// METODO DEPRECADO EN FAVOR DEL METODO NEW DEL CONTROLADOR PEDIDOITEM
//     /**
//      *
//      * @Route("/{idFactura}/addpedido/{idPedido}", name="factura_add_pedido")
//      * @Method("GET")
//      * @Template()
//      */
//      public function facturaAddPedidoAction($idFactura,$idPedido){
//         $em = $this->getDoctrine()->getManager();
//         $entity = $em->getRepository('erpBundle:factura')->find($idFactura);
//         $pedidoEntity = $em->getRepository('erpBundle:Pedido')->find($idPedido);
//         if (!$entity) {
//             throw $this->createNotFoundException('Unable to find factura entity.');
//         }
//         if (!$pedidoEntity) {
//             throw $this->createNotFoundException('Unable to find pedido entity.');
//         }

//         $strings = [];
//         foreach($entity->getMisItems() as $item){
//             $strings[] = $item->getDescripcion();
//         }



//         $pedidoItemEntity = new PedidoItem();
//         $pedidoItemEntity->setCarpintero(implode(" + ",$strings));
//         $pedidoItemEntity->setCantidad(1);
//         $pedidoItemEntity->setFactura($entity);
//         $pedidoEntity->addItem($pedidoItemEntity);



//         $form   = $form = $this->createForm(new PedidoItemsCollectionType(), $pedidoEntity, array(
//                     'action' => $this->generateUrl('pedido_add_items', array('id' => $pedidoEntity->getId())),
//                     'method' => 'PUT',
//                 ));

//         $form->add('submit', 'submit', array('label' => 'Añadir'));

//         return array(
//             'entity'=>$entity,
//             'form'=>$form->createView()
//         );
//    }


    /**
     *
     * @Route("/{id}/download", name="factura_download")
     * @Method("GET")
     */
    public function downloadAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('erpBundle:factura')->find($id);

        $id_direccion = $request->get('id_direccion');
        $conceptounico = $request->get('conceptounico');
        $locale = $entity->getCliente()->getIdioma();
        $request->setLocale($locale);

        $data = $this->forward('erpBundle:factura:show',
        array( 'id' => $id, '_format' => 'pdf', '_locale' => $locale, 'id_direccion' => $id_direccion,
               'conceptounico' => $conceptounico,
        ));


        // Provide a name for your file with extension
       $filename = $entity->getCodFactura().'.pdf';

       // Return a response with a specific content
       $response = new Response($data);

       // Create the disposition of the file
       $disposition = $response->headers->makeDisposition(
           ResponseHeaderBag::DISPOSITION_ATTACHMENT,
           $filename
       );

       // Set the content disposition
       $response->headers->set('Content-Disposition', $disposition);

       // Dispatch request
       return $response;

   }

   function createWooCommerceProduct($entity){
        $woocommerce = new Client(
            'https://www.furgomania.com',
            'ck_9ecb2655fb6c6b5d1a45a69cc8a62dae7f8de444',
            'cs_d69164602db1df97127b8613fb669a65cf28e647',
            [
                'version' => 'wc/v3',
            ]
        );

    
        $result = $woocommerce->post('products',[
            "name" => "Presupuesto ". $entity->getCodFactura(),
            "slug" => "presupuesto-personalizado-".md5($entity->getCodFactura()).'-'.$entity->getCodFactura(),
            "type" => "simple",
            "status" => "publish",
            // "description" => "calculator",
            'short_description' => 'Esta carta de pago se corresponde a la factura proforma '.$entity->getCodFactura().' para '.$entity->getCliente()->getName().' ('.$entity->getCliente()->getDniCif() .') '.' \[calculator\] ',
            "catalog_visibility" => "hidden",
            "regular_price" => number_format($entity->getTotal(),2,'.',''),
            "on_sale" => true,
            "purchasable" => true,
            "stock_quantity" => 1,
            "manage_stock" => true,
            "sold_individually" => true,
            'categories' => [
                [
                    'id' => 124
                ]
            ],
            'images' => [
                    [
                    'src' => 'https://www.furgomania.com/wp-content/uploads/2018/12/webespan%CC%83ol-min.jpg'
                    ]
                ]
        ]);
      
        return $result;
   }


    /**
     *
     * @Route("/{id}/construct_payment", name="factura_construct_payment")
     * @Method("GET")
     */
    public function constructPaymentAction($id, Request $request){
        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('erpBundle:factura')->find($id);
        $result = $this->createWooCommerceProduct($entity);
        return new Response(
            '<html><body><a href="'.$result->permalink.'" target="_new">ir<a/></body></html>'
        );
    }



    /**
     *
     * @Route("/{id}/send", name="factura_enviar")
     * @Method("GET")
     * @Template()
     */
    public function sendAction($id, Request $request){
         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('erpBundle:factura')->find($id);

         $id_direccion = $request->get('id_direccion');
         $conceptounico = $request->get('conceptounico');
         $boton_compra = $request->get('boton_compra');
         $locale = $entity->getCliente()->getIdioma();
         $request->setLocale($locale);

         $data = $this->forward('erpBundle:factura:show',
            array( 'id' => $id, '_format' => 'pdf', '_locale' => $locale, 'id_direccion' => $id_direccion,
                'conceptounico' => $conceptounico, 'boton_compra' => $boton_compra
                ));


        $woocommerceProduct = ($boton_compra) ? $this->createWooCommerceProduct($entity) : false;

        $message = \Swift_Message::newInstance()
            ->setSubject($this->get('translator')->trans(strtoupper($entity->getTipo())).' FURGOMANIA '.$entity->getCodfactura())
            ->setFrom('contacto@furgomania.com')
            ->setTo(trim($entity->getCliente()->getEmail()))
            ->setCc(array('contacto@furgomania.com'))
           // ->setCc(array('info@furgomania.com', 'ventas@furgomania.com','tecnicom@quimp.es'))
            ->setBody(
                $this->renderView(
                    'erpBundle:factura:email.html.twig',
                    array( 'entity'=> $entity,'_locale'=>$locale, 'woocomerceProduct' => $woocommerceProduct )
                ), 'text/html'
            )
            ->attach(\Swift_Attachment::newInstance()
                  ->setFilename($entity->getCodfactura().'.pdf')
                  ->setContentType('application/pdf')
                  ->setBody($data))



        ;
        // $attachment  = $message
        //     ->attach(\Swift_Attachment::fromPath('https://www.furgomania.com/wp-content/uploads/2019/02/tarjetas-de-pago_negro-1-e1549884285953.png')
        //     ->setDisposition('inline'));

        //if($woocommerceProduct){
            $attachment = \Swift_Attachment::fromPath('payment.png')->setDisposition('inline');

            $attachment->getHeaders()->addTextHeader('Content-ID', '<financia>');
            $attachment->getHeaders()->addTextHeader('X-Attachment-Id', 'financia');
            $cid = $message->embed($attachment);
        //}


        $this->get('mailer')->send($message);



        return array(
            'entity'      => $entity
        );
    }

    /**
     * Creates a new factura entity.
     *
     * @Route("/{cliente}", name="factura_create")
     * @Method("POST")
     * @Template("erpBundle:factura:new.html.twig")
     */
    public function createAction(Request $request,\fm\erpBundle\Entity\clientes $cliente = null)
    {
        $entity = new factura();
        $entity->setCliente($cliente);
        $form = $this->createCreateForm($entity,$cliente);
        $form->handleRequest($request);



    if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity->setEstado(1);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('factura', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
    * Creates a form to create a factura entity.
    *
    * @param factura $entity The entity
    * @param cliente $cliente the entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(factura $entity,\fm\erpBundle\Entity\clientes $cliente)
    {
        $form = $this->createForm(new facturaType(), $entity, array(
            'action' => $this->generateUrl('factura_create',['cliente'=>$cliente->getId()]),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Crear Nueva Factura','attr' => array('class' => 'btn black')) );

        return $form;
    }


    /**
     * Displays a form to create a new factura entity.
     *
     * @Route("/new/{cliente}", name="factura_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(\fm\erpBundle\Entity\clientes $cliente = null)
    {
        $entity = new factura();
        $entity->setCliente($cliente);
        $entity->setFecha( new \DateTime() );
        $form   = $this->createCreateForm($entity,$cliente);
        return array(
            'cliente' => $cliente,
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * Finds and displays a factura entity.
     *
     * @Pdf()
     * @Route("/{id}", name="factura_show", requirements={"_locale" = "en|de|fr|es|it"})
     * @Method("GET")
     * @Template()
     */
    public function showAction($id, Request $request)
    {
        $locale = $request->get('_locale');
        $request->setLocale($locale);


        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('erpBundle:factura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find factura entity.');
        }
        if($entity->getDireccionEnvio()) $direccion = $entity->getDireccionEnvio();
        else $direccion = false;

        return array(
            'direccion' => $direccion,
            'entity'      => $entity,
            'id_direccion' => $request->get('id_direccion'),
            'conceptounico' => $request->get('conceptounico')
        );
    }


    /**
     * Finds and displays a concepto unico entity.
     *
     * @Method("GET")
     * @Template()
     */
    public function conceptounicoAction($id, $base)
    {

        $em = $this->getDoctrine()->getManager();
        $entity = $em->getRepository('erpBundle:conceptounico')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find concepto unico entity.');
        }

        return array(
            'base' => $base,
            'entity'      => $entity
        );
    }


    /**
     * Finds and displays a direcciones entity.
     *
     * @Route("/selector/{id}", name="factura_selector_direcciones")
     * @Method("GET")
     * @Template()
     */
    public function selector_direccionesAction($id) {
        $em = $this->getDoctrine()->getManager();
    	$entity = $em->getRepository('erpBundle:factura')->find($id);

        $conceptosunicos = $em->getRepository('erpBundle:conceptounico')->findAll();


    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find direcciones entity.');
    	}
    	return array('entity' => $entity, 'conceptosunicos' => $conceptosunicos);
    }

    /**
     * Displays a form to edit an existing factura entity.
     *
     * @Route("/{id}/edit", name="factura_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:factura')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find factura entity.');
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
    * Creates a form to edit a factura entity.
    *
    * @param factura $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(factura $entity)
    {
        $form = $this->createForm(new facturaType(), $entity, array(
            'action' => $this->generateUrl('factura_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));
        $form->add('submit', 'submit', array('label' => 'Guardar Cambios','attr' => array('class' => 'btn black')) );

        //$form->add('submit', 'submit', array('label' => 'Update','attr' => array('class' => 'btn green')));

        return $form;
    }
    /**
     * Edits an existing factura entity.
     *
     * @Route("/{id}", name="factura_update")
     * @Method("PUT")
     * @Template("erpBundle:factura:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:factura')->find($id);
        // Create an array of the current Tag objects in the database
        $originalItems = $entity->getMisitems()->toArray();

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find factura entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);


        $finalItems = $entity->getMisitems()->toArray();

        if ($editForm->isValid()) {
            foreach ($originalItems as $key => $item) {
                if(!in_array($item,$finalItems))
                    $em->remove($item);
            }


            $em->persist($entity);
            $em->flush();
            return $this->redirect($this->generateUrl('factura', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    private function getSerie($serie,$year,$sociedadId,$grabar = false){
        if(file_exists('series.json'))
            $data = (array) json_decode(file_get_contents('series.json'),true);
        else $data = array();

        $data[$sociedadId][$serie.$year] = isset($data[$sociedadId][$serie.$year]) ? $data[$sociedadId][$serie.$year] +1 : 1;

        if($grabar) file_put_contents('series.json', json_encode($data));
        return $serie.str_pad($data[$sociedadId][$serie.$year],4,"0",STR_PAD_LEFT)."-".$year;
    }


     /**
     * Edits an existing factura entity.
     *
     * @Route("/{id}/grabar", name="factura_grabar")
     * @Template("");
     */
    public function grabarAction(Request $request,$id)
    {

        try{
            $em = $this->getDoctrine()->getManager();

            $entity = $em->getRepository('erpBundle:factura')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find factura entity.');
            }

            $form = $this->createForm(new grabarfacturaType(), $entity, array(
                'action' => $this->generateUrl('factura_grabar', array('id' => $entity->getId())),
                'method' => 'PUT',
            ));

            $form->add('submit', 'submit', array('label' => 'Grabar Factura','attr' => array('class' => 'btn green')) );
            $form->handleRequest($request);
            if ($form->isValid()) {
                $entity->setCodfactura($this->getSerie($entity->getSerie()->getSerie(),$entity->getFecha()->format('Y'),$entity->getSociedad()->getId(),true));
                $entity->setBase();
                $em->persist($entity);
                $em->flush();
                return $this->redirect($this->generateUrl('factura', array('id' => $id)));
            }



            return array(
                'numerofactura' => $this->getSerie($entity->getSerie()->getSerie(),$entity->getFecha()->format('Y'),$entity->getSociedad()->getId()),
                'entity' => $entity,
                'edit_form'   => $form->createView(),
            );
        }catch(\Exception $e){
            return array(
                'numerofactura' => 'Error en la grabacion de la factura',
                'entity' => $entity,
                'edit_form'   => $form->createView(),
            );
        }
    }

    /**
     * Deletes a factura entity.
     *
     * @Route("/{id}", name="factura_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:factura')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find factura entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('factura'));
    }

    /**
     * Creates a form to delete a factura entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('factura_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}