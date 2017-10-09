<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use fm\erpBundle\Entity\Pedido;
use fm\erpBundle\Form\PedidoType;
use fm\erpBundle\Entity\PedidoItem;
use fm\erpBundle\Form\PedidoItemType;
use Doctrine\ORM\EntityRepository;


class PedidoItemsCollectionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('facturas')
            ->add('items', 'collection', array(
                'type'           => new PedidoItemType(),
                'label'          => 'Elementos a incluir en el pedido',
                'by_reference'   => false,
                'prototype'      => new PedidoItem(),
                'allow_delete'   => true,
                'allow_add'      => true,
                'attr'           => array()
            ));
     
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'attr'=> ['id' => 'addItemsForm'],
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
