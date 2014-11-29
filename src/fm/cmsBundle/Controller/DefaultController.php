<?php

namespace fm\cmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('cmsBundle:Default:index.html.twig', array());
    }
}
