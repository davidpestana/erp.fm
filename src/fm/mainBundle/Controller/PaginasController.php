<?php

namespace fm\mainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



class PaginasController extends Controller
{

	 /**
     * Lists all clientes entities.
     *
     * @Route("/concesionarios/")
     * @Method("GET")
     * @Template()
     */
    /*public function concesionariosAction()
    {
        $this->get('seoManager')->metas();

        return array();
    }*/



     /**
     * Lists all clientes entities.
     *
     * @Route("/distribuidores/")
     * @Method("GET")
     * @Template()
     */
    public function distribuidoresAction()
    {
         $this->get('seoManager')->metas();

        return array();
    }

     /**
     * Lists all clientes entities.
     *
     * @Route("/kit-autoinstalable/")
     * @Method("GET")
     * @Template()
     */
    public function kitautoinstalableAction()
    {


        $this->get('seoManager')->metas();

        return array();
    }


     /**
     * Lists all clientes entities.
     *
     * @Route("/furgoneta-camper/")
     * @Method("GET")
     * @Template()
     */
    public function furgonetacamperAction()
    {
        $this->get('seoManager')->metas();

        return array();
    }


     /**
     * Lists all clientes entities.
     *
     * @Route("/quienes-somos/")
     * @Method("GET")
     * @Template()
     */
    public function quienessomosAction()
    {
        $this->get('seoManager')->metas();

        return array();
    }

	
	 /**
     * Lists all clientes entities.
     *
     * @Route("/volkswagen-transporter-furgomania/", schemes = "https")
     * @Method("GET")
     * @Template()
     */
    public function volkswagentransporterfurgomaniaAction()
    {
        $this->get('seoManager')->metas();

        return array();
    }
	

	 /**
     * Lists all clientes entities.
     *
     * @Route("/interesados-transporter-furgomania/")
     * @Method("GET")
     * @Template()
     */
    public function interesadostransporterfurgomaniaAction()
    {
        $this->get('seoManager')->metas();

        return array();
    }	
	
}