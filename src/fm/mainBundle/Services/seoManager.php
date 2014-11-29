<?php
namespace fm\mainBundle\Services;
use Symfony\Component\DependencyInjection\ContainerInterface as Container;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class seoManager
{

    private $container;

    /**
     * 
     */
    public function __construct(Container $container,\Doctrine\ORM\EntityManager $em)
    {
     $this->container = $container;
     $this->em = $em;
    }
 
    private function getRequest(){
        return $this->container->get('request');
    }


    public function metas(){
        $entity = $this->em->getRepository('mainBundle:metas')->findBy(array('path' => $this->getRequest()->getPathInfo()));
        if(isset($entity[0])){
         $this->container->get('sonata.seo.page')
        ->setTitle($entity[0]->getTitle())
        ->addMeta("http-equiv", "Content-Language", $this->getRequest()->getLocale())
        ->addMeta("name", "keywords",$entity[0]->getKeywords())
        ->addMeta("name", "description", $entity[0]->getDescription())
        ->addMeta("name", "author", $entity[0]->getAuthor());
        }
    }
  
}