<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\ordenesfabricacion;
use fm\erpBundle\Entity\productos;
use fm\erpBundle\Form\ordenesfabricacionType;
use Ps\PdfBundle\Annotation\Pdf;



/**
 * ordenesfabricacion controller.
 *
 * @Route("/ordenesfabricacion")
 */
class ordenesfabricacionController extends Controller
{

    /**
     * Lists all ordenesfabricacion entities.
     *
     * @Route("/", name="ordenesfabricacion")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities  = $em->getRepository('erpBundle:ordenesfabricacion')->findAll();
        $productos = $em->getRepository('erpBundle:productos')->findBy(array('tipo' => 'kit'));

        return array(
            'entities' => $entities,
            'productos'=> $productos
        );
    }







/**
     * Lists all ordenesfabricacion entities.
     *
     * @Method("GET")
     * @Template()
     *
 */
    public function estocajeAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities  = $em->getRepository('erpBundle:ordenesfabricacion')->findBy(['mienvio' => null]);



        return array(
            'entities' => $entities
        );
    }  
    /**
     * Creates a new ordenesfabricacion entity.
     *
     * @Route("/", name="ordenesfabricacion_create")
     * @Method("POST")
     * @Template("erpBundle:ordenesfabricacion:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new ordenesfabricacion();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();
           // $this->updateAction($request,$entity->getId());  // como parche para que se guarden los componentes...
            return $this->redirect($this->generateUrl('ordenesfabricacion', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a ordenesfabricacion entity.
    *
    * @param ordenesfabricacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(ordenesfabricacion $entity)
    {
        $form = $this->createForm(new ordenesfabricacionType(), $entity, array(
            'action' => $this->generateUrl('ordenesfabricacion_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new ordenesfabricacion entity.
     *
     * @Route("/new/{product}", name="ordenesfabricacion_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction($product = null)
    {

       // numero de serie para la orden de fabricacion
       $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
       $random = ""; for($i=0;$i<6;$i++) $random .= substr($str,rand(0,62),1);


       $entity = new ordenesfabricacion();
       $entity->setFecha( new \DateTime() );
       $entity->setNumeroserie($random);



 
        if($product != null){
         $em = $this->getDoctrine()->getManager();
         $product = $em->getRepository('erpBundle:productos')->find($product);
         $entity->setProducto($product->getConcepto());
         $entity->setContenido($product->getContenido());
        } 
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }



     /**
     * Displays a form to create a new ordenesfabricacion entity.
     *
     * @Route("/clone/{id}", name="ordenesfabricacion_clone")
     * @Method("GET")
     * @Template("erpBundle:ordenesfabricacion:new.html.twig")
     */
    public function cloneAction($id)
    {

       // numero de serie para la orden de fabricacion
       $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
       $random = ""; for($i=0;$i<6;$i++) $random .= substr($str,rand(0,62),1);

         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('erpBundle:ordenesfabricacion')->find($id);
         $entity->setFecha( new \DateTime() );
         $entity->setNumeroserie($random);
        
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }


    /**
     * Finds and displays a ordenesfabricacion entity.
     *
     * @Pdf()
     * @Route("/{id}", name="ordenesfabricacion_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:ordenesfabricacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ordenesfabricacion entity.');
        }

        return array(
            'entity'      => $entity
        );
    }


    /**
     * Finds and displays a ordenesfabricacion entity.
     *
     * @Route("/{id}/send", name="ordenesfabricacion_send")
     * @Method("GET")
     * @Template()
     */
    public function sendAction($id){
         $em = $this->getDoctrine()->getManager();
         $entity = $em->getRepository('erpBundle:ordenesfabricacion')->find($id);
            $entity->setEstado('enviado');
            $entity->setFecha(new \DateTime());
            $em->persist($entity);
            $em->flush();

         $data = $this->forward('erpBundle:ordenesfabricacion:show', 
            array( 'id' => $id, '_format' => 'pdf'));


        $message = \Swift_Message::newInstance()
            ->setSubject('FM: ORDEN DE FABRICACION '.$entity->getNumeroserie())
            ->setFrom('contacto@furgomania.com')
            ->setTo('ventas@furgomania.com')
            ->setBody(
                $this->renderView(
                    'erpBundle:ordenesfabricacion:email.html.twig',
                    array( 'entity'      => $entity)
                ), 'text/html'
            )
            ->attach(\Swift_Attachment::newInstance()
                  ->setFilename('ordenfabricacion.'.$entity->getNumeroserie().'.pdf')
                  ->setContentType('application/pdf')
                  ->setBody($data))
        ;

        $this->get('mailer')->send($message);
        return array(
            'entity'      => $entity
        );
    }
    /**
     * Displays a form to edit an existing ordenesfabricacion entity.
     *
     * @Route("/{id}/edit", name="ordenesfabricacion_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:ordenesfabricacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ordenesfabricacion entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a ordenesfabricacion entity.
    *
    * @param ordenesfabricacion $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(ordenesfabricacion $entity)
    {
        $form = $this->createForm(new ordenesfabricacionType(), $entity, array(
            'action' => $this->generateUrl('ordenesfabricacion_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing ordenesfabricacion entity.
     *
     * @Route("/{id}", name="ordenesfabricacion_update")
     * @Method("PUT")
     * @Template("erpBundle:ordenesfabricacion:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:ordenesfabricacion')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find ordenesfabricacion entity.');
        }

        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ordenesfabricacion', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a ordenesfabricacion entity.
     *
     * @Route("/{id}", name="ordenesfabricacion_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:ordenesfabricacion')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find ordenesfabricacion entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ordenesfabricacion'));
    }

    /**
     * Creates a form to delete a ordenesfabricacion entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ordenesfabricacion_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
