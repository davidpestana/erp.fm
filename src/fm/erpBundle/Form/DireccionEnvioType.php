<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DireccionEnvioType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('dniCif')
            ->add('direccion')
            ->add('telefono')
            ->add('email')
            ->add('persona')
            ->add('localidad')
            ->add('provincia')
            ->add('cp')
            ->add('cliente')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\DireccionEnvio'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_erpbundle_direccionenvio';
    }
}
