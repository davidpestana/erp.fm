<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class productosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('concepto')
            ->add('tipo','choice', array(
                                        'choices'   => array(
                                            'kit'   => 'Kit',
                                            'accesorio' => 'accesorios, neveras y demas',
                                            'colchon' => 'Juego de Colchonetas',
                                            'envio'   => 'Gastos de Envio',
                                            'otros'   => 'otros'
                                            )
                                        )
                                )
            ->add('precio')
            ->add('descuento',null,array('label' => 'descuento oferta'))
            ->add('contenido',null,array('expanded' => true));

#            ->add('Referencia','entity',array(
 #                                       'class'=>'erpBundle:referencias',
  #                                      'property' => 'descripcion',
   #                                     'expanded' => true, 'multiple' => true ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\productos'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_erpbundle_productostype';
    }
}
