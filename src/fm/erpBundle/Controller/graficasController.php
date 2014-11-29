<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * cajones controller.
 *
 * @Route("/graficas")
 */
class graficasController extends Controller
{

    /**
     * Lists all cajones entities.
     *
     * @Route("/", name="grafica")
     * @Method("GET")
     */
    public function facturacionmesesAction(){
    	$response = new JsonResponse();

    	$d1 = array();
    	$d2 = array();
    	for($i = 1; $i < 13; $i++){
    		$d1[] = array($i,rand(1,12));
    		$d2[] = array($i,rand(1,12));
    	}

        $em = $this->getDoctrine()->getManager();

 		$facturas = $em->getRepository('erpBundle:factura')->findby(array("estado" => 2));
 		$series = array();
 		foreach($facturas as $factura){

 			$month = strtotime($factura->getFecha()->format('Y-m-01'))*1000;

 			    $series[$factura->getSerie()->getDescripcion()][$month] = 
 				isset($series[$factura->getSerie()->getDescripcion()][$month]) ?
 				$series[$factura->getSerie()->getDescripcion()][$month] + $factura->getBase():
 				$factura->getBase();
        }     


        $datos = array();
        foreach($series as $label => $months){
        	$data = array();
         ksort($months);
        	foreach($months as $month => $total){
        		$data[] = array($month,$total);
        	}
       		$datos[] = array("data" => $data, "label" => $label);
        }



		$response->setData($datos);
		return $response;
    }
}