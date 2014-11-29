<?php

namespace fm\mainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\True;

class clienteType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array("label" => "Nombre o Razón Social"))
            ->add('dni_cif',null,array("label" => "D.N.I, C.I.F o N.I.E."))
            ->add('direccion',null,array("label" => "Dirección"))
            ->add('provincia')
            ->add('localidad')
            ->add('cp',null,array("label" => "Código Postal"))
            ->add('telefono',null,array("label" => "Teléfono"))
            ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\clientes'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_mainbundle_cliente';
    }
}