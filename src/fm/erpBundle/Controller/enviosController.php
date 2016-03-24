<?php

namespace fm\erpBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use fm\erpBundle\Entity\envios;
use fm\erpBundle\Form\enviosType;
use Ps\PdfBundle\Annotation\Pdf;


/**
 * envios controller.
 *
 * @Route("/envios")
 */
class enviosController extends Controller
{

    /**
     * Lists all envios entities.
     *
     * @Route("/", name="envios")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('erpBundle:envios')->findAll();
        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new envios entity.
     *
     * @Route("/", name="envios_create")
     * @Method("POST")
     * @Template("erpBundle:envios:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new envios();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);


        if ($form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            foreach($entity->getMisordenes()->toArray() as $orden) 
            {                
                $orden->setMienvio($entity);
                $em->persist($orden);
                
            }  


            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('envios'));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
    * Creates a form to create a envios entity.
    *
    * @param envios $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createCreateForm(envios $entity)
    {
        $form = $this->createForm(new enviosType(), $entity, array(
            'action' => $this->generateUrl('envios_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new envios entity.
     *
     * @Route("/new", name="envios_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction(\fm\erpBundle\Entity\clientes $cliente = null)
    {
        $entity = new envios();

        $entity->setCliente($cliente);
        $entity->setFecha( new \DateTime() );
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a envios entity.
     *
     * @Pdf()
     * @Route("/{id}", name="envios_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:envios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find envios entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }



    /**
     * Finds and displays a ordenesfabricacion entity.
     *
     * @Pdf()
     * @Route("/etiquetas/{id}", name="envios_etiquetas")
     * @Method("GET")
     * @Template()
     */
    public function etiquetasAction($id)
    {

       $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:envios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find envios entity.');
        }


        return array(
            'entity'      => $entity
        );
    }
    
    /**
     * Displays a form to edit an existing envios entity.
     *
     * @Route("/{id}/edit", name="envios_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:envios')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find envios entity.');
        }

        $editForm = $this->createEditForm($entity);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }

    /**
    * Creates a form to edit a envios entity.
    *
    * @param envios $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(envios $entity)
    {
        $form = $this->createForm(new enviosType(), $entity, array(
            'action' => $this->generateUrl('envios_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing envios entity.
     *
     * @Route("/{id}", name="envios_update")
     * @Method("PUT")
     * @Template("erpBundle::layout.redirect.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('erpBundle:envios')->find($id);


        if (!$entity) {
            throw $this->createNotFoundException('Unable to find envios entity.');
        }

        $editForm = $this->createEditForm($entity);

         // Create an array of the current Tag objects in the database

        $originalMisordenes = $entity->getMisordenes()->toArray();

        // atach requested form to entity

        $editForm->handleRequest($request);

         // Create an array of the future Tag objects in the database

        $finalMisordenes = $entity->getMisordenes()->toArray();

        if ($editForm->isValid()) {


            foreach ($originalMisordenes as $orden) {
                if(!in_array($orden,$finalMisordenes)){
                    $orden->setMienvio(NULL);
                    $em->persist($orden);
                }
            }   

            foreach($finalMisordenes  as $orden) 
            {                
                if(!in_array($orden, $originalMisordenes)){       
                        $orden->setMienvio($entity);
                        $em->persist($orden);
                }
            }      

            

            $em->flush();
            return $this->redirect($this->generateUrl('envios'));
        }



        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
        );
    }
    /**
     * Deletes a envios entity.
     *
     * @Route("/{id}", name="envios_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('erpBundle:envios')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find envios entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('envios'));
    }

    /**
     * Creates a form to delete a envios entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('envios_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
