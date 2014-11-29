<?php

namespace fm\mainBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



class InheritedController extends Controller
{



	 /**
     *
     * @Route("/albums/menu.html")
     * @Method("GET")
     * @Template()
     */
    public function albumsmenuAction()
    {


             $this->container->get('sonata.seo.page')
        ->setTitle("Furgomania, Albums Furgonetas Camper")
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", "Furgoneta Camper, furgoneta cama, Albums")
        ->addMeta("name", "description", "Solucion para Furgoneta Camper, sin ITV, sin herramientas Albums de trabajos furgomania");
        $this->get('seoManager')->metas();


        $entities = $this->getDoctrine()->getManager()
        			->getRepository('mainBundle:ialbums')->findAll();
        return array(
            'entities' => $entities,
        );
    }


	 /**
     *
     * @Route("/albums/{slug}.html")
     * @Method("GET")
     * @Template()
     */
    public function albumsAction($slug)
    {
    	$entity = $this	->getDoctrine()->getManager()
    					->getRepository('mainBundle:ialbums')
    					->findOneBy(array("slug" =>$slug));


             $this->container->get('sonata.seo.page')
        ->setTitle($entity->getTitulo())
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", $entity->getKeywords())
        ->addMeta("name", "description", $entity->getDescripcion());
        $this->get('seoManager')->metas();



        if($entity != null){
			return array("entity" => $entity);
        }else throw $this->createNotFoundException();
    }



	 /**
     *
     * @Route("/fotos/menu.html")
     * @Method("GET")
     * @Template()
     */
    public function fotosmenuAction()
    {
        $entities = $this->getDoctrine()->getManager()
        			->getRepository('mainBundle:ialbums')->findAll();
        return array(
            'entities' => $entities,
        );
    }
   	/**
     *
     * @Route("/fotos/{slug}.html")
     * @Method("GET")
     * @Template()
     */
    public function fotosAction($slug)
    {
    	$entity = $this	->getDoctrine()->getManager()
    					->getRepository('mainBundle:ifotos')
    					->findOneBy(array("slug" =>$slug));

         $this->container->get('sonata.seo.page')
        ->setTitle($entity->getTitulo())
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords", $entity->getKeywords())
        ->addMeta("name", "description", $entity->getDescripcion());
        $this->get('seoManager')->metas();

        if($entity != null){
			return array("entity" => $entity);
        }else throw $this->createNotFoundException();    
    }



     /**
     *
     * @Route("/trabajos/menu.html")
     * @Method("GET")
     * @Template()
     */
    public function trabajosmenuAction()
    {
        $entities = $this->getDoctrine()->getManager()
                    ->getRepository('mainBundle:trabajos')->findAll();
        return array(
            'entities' => $entities,
        );
    }
    
     /**
     *
     * @Route("/trabajos/{slug}.html")
     * @Method("GET")
     * @Template()
     */
    public function trabajosAction($slug)
    {
    	$entity = $this	->getDoctrine()->getManager()
    					->getRepository('mainBundle:trabajos')
    					->findOneBy(array("slug" =>$slug));


        if($entity != null){

                         $this->container->get('sonata.seo.page')
                        ->setTitle($entity->getTitulo())
                        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
                        ->addMeta("name", "keywords", $entity->getKeywords())
                        ->addMeta("name", "description", $entity->getDescripcion());
                                $this->get('seoManager')->metas();

			return array("entity" => $entity);
        }else throw $this->createNotFoundException();       


         }


     /**
     *
     * @Route("/videos/{slug}.html")
     * @Method("GET")
     * @Template()
     */
    public function videosAction($slug)
    {
                $this->get('seoManager')->metas();
                return array();

    	/*$entity = $this	->getDoctrine()->getManager()
    					->getRepository('mainBundle:ivideos')
    					->findOneBy(array("slug" =>$slug));


        if($entity != null){
			return array("entity" => $entity);
        }else throw $this->createNotFoundException();*/
    }
      


}