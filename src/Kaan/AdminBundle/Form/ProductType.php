<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('description')
                ->add('permalink')
                ->add('sku')
                ->add('avaibleOn')
                ->add('price', 'money')
                ->add('stock')
                ->add('image')
                ->add('variantMode')
                ->add('shippingCategory')
                ->add('taxationCategory')
                ->add('taxonomies', 'entity', array(
                    'class' => 'CoreBundle:Taxonomies',
                    'multiple' => TRUE,
                    'query_builder' => function($er) {
                        return $er->createQueryBuilder('t')
                                ->orderBy('t.root', 'ASC')
                                ->where('t.lvl > 0')
                                ->addOrderBy('t.lft', 'ASC');
                    },
                    'attr' => array('class' => 'chosen')
                ))
                ->add('options')
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
