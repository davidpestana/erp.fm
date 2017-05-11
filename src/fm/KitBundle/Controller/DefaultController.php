<?php

namespace fm\KitBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\mainBundle\Entity\contacto;
use fm\mainBundle\Form\contactoType;

class DefaultController extends Controller
{
	 /**
     * Explicacion de los kits y modelos
     *
     * @Route("/kits/")
     * @Method("GET")
     * @Template()
     */
    public function kitsAction()
    {
        $this->get('seoManager')->metas();

        return array();
    }


   	/**
     * Kits disponibles para un vehiculo
     *
     * @Route("/furgoneta-camper/{marca}/")
     * @Method("GET")
     * @Template()
     */
    public function marcaAction($marca)
    {


        $seo = $this->container->get('sonata.seo.page')
        ->setTitle("Furgomania, Furgonetas Camper {$marca}")
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", "Furgoneta Camper {$marca}")
        ->addMeta("name", "description", "Solucion para Furgoneta Camper {$marca}, sin ITV, sin herramientas, kit auto instalable Furgomania para {$marca} ")
        ->addMeta("property","og:description","Solucion para Furgoneta Camper {$marca}, sin ITV, sin herramientas, kit auto instalable Furgomania para {$marca} ");
        $this->get('seoManager')->metas();

      	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KitBundle:kits')
        	->findBy(array('marcaslug' => $marca ));

        $vehiculos = $em->getRepository('KitBundle:vehiculos')
            ->findBy(array('marcaslug' => $marca ));
/*        if (!count($entities)) {
            $form = $this->createForm(new contactoType(), new contacto());
            return $this->render('KitBundle:Default:disclaimermarca.html.twig',array("marca" => $marca,"entities" =>$vehiculos,"form" => $form->createView()));
        }
*/
        $modelo = $vehiculos[0]->getModeloslug();
        $seo->addMeta("property","og:image","/img/furgos/{$marca}-{$modelo}.jpg");



        return array("marca" => $marca,'entities' => $entities, 'modelos' => $vehiculos);
    }




   	/**
     * Kits disponibles para un vehiculo
     *
     * @Route("/furgoneta-camper/{marca}/{modelo}/")
     * @Method("GET")
     * @Template()
     */
    public function vehiculoAction($marca,$modelo)
    {


             $this->container->get('sonata.seo.page')
        ->setTitle("Furgomania, {$marca} {$modelo}")
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", "Furgoneta Camper, furgoneta cama, {$marca} {$modelo}")
        ->addMeta("name", "description", "{$marca} {$modelo}, Solucion para Furgoneta Camper, sin ITV, sin herramientas, kit auto instalable Furgomania para {$marca} {$modelo}");

        $this->get('seoManager')->metas();

      	$em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('KitBundle:kits')
        	->findBy(array('marcaslug' => $marca, 'modeloslug' => $modelo ));
        if (!count($entities)) {

            $entity = new contacto();
            $form = $this->createForm(new contactoType(), $entity);
            return $this->render('KitBundle:Default:disclaimer.html.twig',array("marca" => $marca,"modelo" =>$modelo,"form" => $form->createView()));
        }


        return array('entities' => $entities,'marca' => $entities[0]->getMarca(), 'modelo' => $entities[0]->getModelo()) ;
    }

    /**
     * pagina de producto
     *
     * @Route("/furgoneta-camper/{marca}/{modelo}/{kit}/")
     * @Method("GET")
     * @Template()
     */
    public function kitAction($marca,$modelo,$kit)
    {


             $this->container->get('sonata.seo.page')
        ->setTitle("Furgomania,{$kit} {$marca} {$modelo}")
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", "Furgoneta Camper, furgoneta cama,{$kit} {$marca} {$modelo}")
        ->addMeta("name", "description", "{$kit} {$marca} {$modelo}, Solucion para Furgoneta Camper, sin ITV, sin herramientas, kit auto instalable Furgomania para {$kit} {$marca} {$modelo}");

        $this->get('seoManager')->metas();

      	$em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('KitBundle:kits')
        	->findOneBy(array('marcaslug' => $marca, 'modeloslug' => $modelo,'slug' => $kit ));
        if (!$entity) {
            throw $this->createNotFoundException('Unable to find clientes entity.');
        }


        return array("entity" => $entity);
    }
}
