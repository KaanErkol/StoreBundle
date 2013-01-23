<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Kaan\AdminBundle\Form\ProductAttributeType;
use Kaan\AdminBundle\Form\VariantValueType;

class VariantType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder
                ->add('sku', 'text', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'span1')
                ))
                ->add('avaibleOn', 'datetime', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    )
                ))
                ->add('avaible', null, array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    )
                ))
                ->add('price', 'text', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'span1', 'prepend_input' => '$')
                ))
                ->add('stock', 'integer', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'span1')
                ))
                ->add('shippingCategory', null, array(
                    'attr' => array('class' => 'chosen span2'),
                    'label_attr' => array(
                        'class' => 'control-label'
                    )
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\Product'
        ));
    }

    public function getName() {
        return 'kaan_corebundle_producttype';
    }

}
