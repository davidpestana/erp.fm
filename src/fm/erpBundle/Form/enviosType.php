<?php

namespace fm\erpBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;


class enviosType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $id = $builder->getData()->getId();
        $builder
            ->add('observaciones')
            ->add('observaciones_entrega')

            ->add('fecha')
            ->add('estado')
            //->add('cliente')
            ->add('factura')
            ->add('misordenes',null,array(
                'expanded' => false,
                'label' => 'selecciona bultos a incluir en el envio',
                'class' => 'erpBundle:ordenesfabricacion',
                'query_builder' => function (EntityRepository $er) use( $id ){
                        return $er->createQueryBuilder('u')->where('u.mienvio is NULL')->orwhere('u.mienvio =?1')->setParameter(1,$id);
                                    }
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'fm\erpBundle\Entity\envios'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'fm_erpbundle_envios';
    }
}
