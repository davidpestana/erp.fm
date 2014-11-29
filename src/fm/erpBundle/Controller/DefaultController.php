<?php

namespace fm\erpBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function indexAction()
    {

        $em = $this->getDoctrine()->getManager();

 		$facturas = $em->getRepository('erpBundle:factura')->findby(array("estado" => 2));
 		$facturado = 0;
        $pendientes = array();
        //$proformas = array();

 		foreach($facturas as $factura){
             $facturado += $factura->getBase() * $factura->getSerie()->getOperador();
             if($factura->getFechaPagado() == null) $pendientes[] = $factura;
          //   if($factura->getSerie()->getOperador() == 0) $proformas[] = $factura;
        }     


       
        return $this->render('erpBundle:Default:index.html.twig', 
            array(  "facturas" =>  count($facturas), 
                    "facturado" => $facturado, 
                    "gastos" => 0, 
                    "beneficio" => 0,
                    "pendientes" => $pendientes,
                    //"proformas" => $proformas 
                    ));
    }


    public function selectwidgetAction($select){
    		return $this->render("erpBundle:Default:selectwidget.html.twig",array("select" => $select));
    }

    public function iframeAction($url){
    		return $this->render("erpBundle:Default:iframe.html.twig",array("url" => $url));
    }


}
