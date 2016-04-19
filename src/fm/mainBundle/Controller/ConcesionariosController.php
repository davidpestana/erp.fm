<?php

namespace fm\mainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use fm\mainBundle\Entity\concesionario;

/**
 * @Route("/concesionarios")
 */
class ConcesionariosController extends Controller
{
	 /**
     * @Route("/")
     */
    public function indexAction()
    {

    	$em = $this->getDoctrine()->getManager();

        $concesionarios = $em->getRepository('mainBundle:concesionario')->findAll();


        return $this->render('mainBundle:Concesionarios:index.html.twig', array(
            "concesionarios" => $concesionarios,
        ));
    }

}
