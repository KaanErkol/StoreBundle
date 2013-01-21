<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Kaan\AdminBundle\Form\ProductAttributeType;

class ProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder
                ->add('name', 'text', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'input-xxlarge')
                ))
                ->add('description', 'textarea', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'input-xxlarge description')
                ))
                ->add('permalink', 'text', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'input-xlarge')
                ))
                ->add('sku', 'text', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'input-xlarge')
                ))
                ->add('avaibleOn', 'datetime', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    )
                ))
                ->add('price', 'text', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'input-xlarge', 'prepend_input' => '$')
                ))
                ->add('stock', 'integer', array(
                    'label_attr' => array(
                        'class' => 'control-label'
                    ),
                    'attr' => array('class' => 'input-xlarge')
                ))
                ->add('variantMode', 'choice', array(
                    'choices' => array(
                        '0' => 'Display List Variant',
                        '1' => 'Display Option'
                    ),
                    'label_attr' => array(
                        'class' => 'control-label'
                    )
                ))
                ->add('shippingCategory', null, array(
                    'attr' => array('class' => 'chosen'),
                    'label_attr' => array(
                        'class' => 'control-label'
                    )
                ))
                ->add('taxationCategory', null, array(
                    'attr' => array('class' => 'chosen'),
                    'label_attr' => array(
                        'class' => 'control-label'
                    )
                ))
                ->add('options', null, array(
                    'attr' => array('class' => 'chosen'),
                    'label_attr' => array(
                        'class' => 'control-label'
                    )
                ))
                ->add('attribute', 'collection', array(
                    'type' => new ProductAttributeType(),
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => true,
                        )
                )
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
