<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductAttributeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('attribute',null,array(
                'required' => TRUE,
                'attr' => array('class' => 'chosen')
            ))
            ->add('value')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\ProductAttribute'
        ));
    }

    public function getName()
    {
        return 'kaan_corebundle_productattributetype';
    }
}
