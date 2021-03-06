<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;


use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class PedidoItemType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('posicion')
            ->add('carpintero')
            ->add('tapicero')
            ->add('factura')
            ->add('pedido')
            // ->add('proveedor','choice', array(
            //     'choices' => array(
            //         'masferrer'   => 'Mas Ferrer',
            //         'tapicero' => 'Tapicero'
            //     ),
            //     'multiple' => false,
            // ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\PedidoItem'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_erpbundle_pedidoitem';
    }
}
