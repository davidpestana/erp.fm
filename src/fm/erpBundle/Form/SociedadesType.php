<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SociedadesType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('razonSocial')
            ->add('nif')
            ->add('direccion')
            ->add('cp')
            ->add('localidad')
            ->add('provincia')
            ->add('entidad')
            ->add('iban')
            ->add('bic')
            ->add('codigoCuenta')
            ->add('observaciones')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\Sociedades'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_erpbundle_sociedades';
    }
}
