<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ZoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('child','entity',array(
                'class' => 'CoreBundle:Country',
                'multiple' => true,
                'attr' => array(
                    'class' => 'chosen'
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\Zone'
        ));
    }

    public function getName()
    {
        return 'kaan_corebundle_zonetype';
    }
}
