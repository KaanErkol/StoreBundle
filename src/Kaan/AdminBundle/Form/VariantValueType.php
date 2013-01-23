<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityManager;
use Kaan\AdminBundle\Form\ProductAttributeType;
use Kaan\AdminBundle\Form\VariantType;

class VariantValueType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {


        $builder
                ->add('value',null,array(
                    'disabled' => TRUE
                ))
                ->add('option',null,array(
                    'disabled' => TRUE
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\OptionValue'
        ));
    }

    public function getName() {
        return 'kaan_corebundle_producttype';
    }

}
