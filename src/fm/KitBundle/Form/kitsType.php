<?php

namespace fm\KitBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class kitsType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('slug')
            ->add('descripcion')
            ->add('galeria','collection', array(
                    'allow_add' => true,
                    'allow_delete' => true,
                ))
            ->add('features','collection', array(
                    'allow_add' => true,
                    'allow_delete' => true,
                ))
            ->add('contenido','collection', array(
                    'allow_add' => true,
                    'allow_delete' => true,
                ))
            ->add('precio')
            ->add('descuento')
            ->add('marca')
            ->add('marcaslug')
            ->add('modelo')
            ->add('modeloslug')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\KitBundle\Entity\kits'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_kitbundle_kits';
    }
}
