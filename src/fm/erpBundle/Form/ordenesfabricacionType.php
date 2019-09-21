<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ordenesfabricacionType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numeroserie')
            ->add('producto')
            ->add('origen')
            ->add('estado')
            ->add('fecha', 'date', array('widget' => 'single_text'))
            // ->add('mienvio')
            ->add('micajon',null,['required' => true, 'empty_value' => 'selecciona el tipo de cajón', 'empty_data' => null])
            ->add('referencia',null,['required' => true, 'empty_value' => 'selecciona la referencia de pedido', 'empty_data' => null])
            // ->add('contenido',null,array('expanded' => true))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\ordenesfabricacion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_erpbundle_ordenesfabricacion';
    }
}
