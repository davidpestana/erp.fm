<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use fm\erpBundle\Entity\item;
use fm\erpBundle\Form\itemType;
use Doctrine\ORM\EntityRepository;


class facturaType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
/*->add('serie','choice', array(
    'choices'   => array('FV' => 'Factura de Venta (FV)', 'FM' => 'Factura Proforma (FM)' , 'FR' => 'Factura Rectificativa (FR)', 'AB' => 'Factura de Abono (AB)'),
    'required'  => true,
))*/        ->add('sociedad')
            ->add('serie', 'entity', array(
                'class' => 'erpBundle:series',
                    'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')->orderBy('u.bydefault', 'DESC');
                },
            ))
            ->add('fecha')
            //->add('total')
            ->add('iva',null,array('label' => 'IVA %'))
            ->add('observaciones')
            //->add('estado')
            ->add('cliente')
          //  ->add('misitems')
            ->add('misitems', 'collection', array(
                'type'           => new itemType(),
                'label'          => 'Productos en la Factura',
                'by_reference'   => false,
                'prototype'      => new item(),
                'allow_delete'   => true,
                'allow_add'      => true,
                'attr'           => array()
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\factura'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_erpbundle_factura';
    }
}
