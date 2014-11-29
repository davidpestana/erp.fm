<?php

namespace fm\mainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\mainBundle\Entity\contacto;
use fm\mainBundle\Form\contactoType;
use fm\erpBundle\Entity\clientes;
use fm\mainBundle\Form\clienteType;


class DefaultController extends Controller
{

	 /**
     * Lists all clientes entities.
     *
     * @Route("/",name="homepage")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {



        $this->container->get('sonata.seo.page')
        ->setTitle("Furgomania, Furgonetas Camper")
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", "Furgoneta Camper, furgoneta cama, Volkswagen Transporter T5, Nissan PrimaStar NV200, Opel Vivaro, Renault Traffic, Ford")
        ->addMeta("name", "description", "Solucion para Furgoneta Camper, sin ITV, sin herramientas, kit auto instalable Furgomania para furgonetas Volkswagen, Renault, ");
        
        $this->get('seoManager')->metas();

        return array();
    }


     /**
     * Lists all clientes entities.
     *
     * @Route("/tienda",name="tienda")
     * @Method("GET")
     * @Template()
     */
    public function tiendaAction()
    {
        $this->container->get('sonata.seo.page')
        ->setTitle("Furgomania, Tienda de Accesorios para Furgonetas Camper")
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", "Accesorios para Furgoneta Camper, neveras waeco, depositos de agua para furgoneta,  furgoneta cama, Volkswagen Transporter T5, Nissan PrimaStar NV200, Opel Vivaro, Renault Traffic, Ford")
        ->addMeta("name", "description", "Solucion para Furgoneta Camper, accesorios, neveras, toldos, depositos, avances, kit auto instalable Furgomania para furgonetas Volkswagen, Renault, ");
        
        $this->get('seoManager')->metas();

        return array();
    }



    	 /**
     * Lists all clientes entities.
     *
     * @Route("/contacto")
     * @Template()
     */
    public function contactoAction(Request $request)
    {

       $this->container->get('sonata.seo.page')
        ->setTitle("Contacto Furgomania")
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", "Furgonetas Camper, contacto furgomania")
        ->addMeta("name", "description", "Ponte en contacto con el equipo Furgomania, Soluciones Furgoneta Camper");

        $this->get('seoManager')->metas();


        $entity = new contacto();
        $form = $this->createForm(new contactoType(), $entity);
        if ($request->getMethod() == 'POST') {
                $form->handleRequest($request);
                if ($form->isValid()) {
                    $entity->setDateat( new \DateTime() );
                    $entity->setCp('00000');
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($entity);
                    $em->flush();
                    $this->sendMail($entity);
                    $this->get('session')->getFlashBag()->add(
                             'notice',
                            'correo correctamente enviado a '.$entity->getEmail());
                    return $this->redirect(
                        $this->generateUrl('fm_main_default_postcontacto',
                        array("token" => $this->get('cryptManager')->encrypt($entity))
                        ));
                }
        }
        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );

    }


    /**
     * 
     *
     * @Route("/gracias/{token}")
     * @Template()
     */
    public function postcontactoAction(Request $request,$token)
    {

        $this->container->get('sonata.seo.page')
        ->setTitle("Furgomania, Furgonetas Camper")
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", "Furgoneta Camper, furgoneta cama, Volkswagen Transporter T5, Nissan PrimaStar NV200, Opel Vivaro, Renault Traffic, Ford")
        ->addMeta("name", "description", "Solucion para Furgoneta Camper, sin ITV, sin herramientas, kit auto instalable Furgomania para furgonetas Volkswagen, Renault, ");

        $this->get('seoManager')->metas();


        $contacto = $this->get('cryptManager')->decrypt($token);
       
        $em = $this->getDoctrine()->getManager();

        if(!$cliente = $em->getRepository('erpBundle:clientes')->findOneBy(array("email" => $contacto->getEmail()))){
            $cliente = new clientes();
            $cliente->setName($contacto->getName());
            $cliente->setCp($contacto->getCp());
            $cliente->setProvincia($contacto->getProvincia());
            $cliente->setEmail($contacto->getEmail());
            $cliente->setTelefono($contacto->getTelefono());
            $cliente->setObservaciones("Cliente Autocreado");
            $cliente->setFurgo($contacto->getFurgo());
        }

        $form = $this->createForm(new clienteType(), $cliente);
  
        if ($request->getMethod() == 'POST') {
                $form->handleRequest($request);
                if ($form->isValid()) {              
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($cliente);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add(
                             'notice',
                            'hemos registrado tus datos correctamente, muchas gracias');

                    return $this->redirect($this->generateUrl('fm_main_default_postcontacto',array('token' => $token)));
                }
        }
        return array(
            'token'  => $token,
            'cliente' => $cliente,
            'contacto' => $contacto,
            'form'   => $form->createView(),
        );

    }

    public function leftsideAction()
    {
        return $this->render( 'mainBundle:Default:leftside.html.twig', array ());
    }

    public function rightsideAction()
    {
        return $this->render( 'mainBundle:Default:rightside.html.twig', array ());
    }



    private function sendMail($entity){

        $message = \Swift_Message::newInstance()
            ->setSubject("CONTACTO: ".$entity->getName())
            ->setFrom('contacto@furgomania.com')
            ->setTo(array($entity->getEmail(),"contacto@furgomania.com"))
            //->setCc('contacto@furgomania.com')
            ->setBody(
                $this->renderView(
                    'mainBundle:Default:email.contacto.html.twig',
                    array( 'entity'=> $entity)
                ), 'text/html'
            )
        ;

        $this->get('mailer')->send($message);

    }



}
