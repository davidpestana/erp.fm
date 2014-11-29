<?php

namespace fm\mainBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Validator\Constraints\True;

class contactoType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',null,array("label" => "Nombre"))
            ->add('email','email')
            ->add('telefono',null,array("label" => "Teléfono"))
            ->add('provincia')
            ->add('pais')
            //->add('cp')
            ->add('furgo',null, array(
                'required'  => false,'label' => "Vehículo"
            ))
            ->add('mensaje')
            ->add("terms", "checkbox", 
                array(
        "label" => "acepto los terminos y condiciones generales",
        "mapped" => false,
        "constraints" => new True(array(
            "message" => "Please accept the Terms and conditions in order to register")
        )));
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\mainBundle\Entity\contacto'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_mainbundle_contacto';
    }
}
