<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use fm\erpBundle\Entity\PedidoItem;
use fm\erpBundle\Form\PedidoItemType;
use Doctrine\ORM\EntityRepository;


class PedidoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('fechaEntrega');
            // ->add('items', 'collection', array(
            //     'type'           => new PedidoItemType(),
            //     'label'          => 'Elementos a incluir en el pedido',
            //     'by_reference'   => false,
            //     'prototype'      => new PedidoItem(),
            //     'allow_delete'   => true,
            //     'allow_add'      => true,
            //     'attr'           => array()
            // ));
            // ->add('misFacturas', 'entity', array(
            //     'class' => 'erpBundle:factura',
            //         'query_builder' => function (EntityRepository $er) {

            //            // ldd($er->createQueryBuilder('u'));
            //             return $er->createQueryBuilder('u')
            //             ->where('u.pedido is null')
            //             ->orderBy('u.codfactura', 'DESC');

            //        // return $er->createQueryBuilder('factura');
            //     },
            // ));
            // ->add('misFacturas', 'collection', array(
            //     'type'           => new facturaType(),
            //     'label'          => 'Facturas incluidas a este pedido',
            //     'by_reference'   => false,
            //     'prototype'      => new factura(),
            //     'allow_delete'   => true,
            //     'allow_add'      => true,
            //     'attr'           => array()
            // ))        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\Pedido'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_erpbundle_pedido';
    }
}
