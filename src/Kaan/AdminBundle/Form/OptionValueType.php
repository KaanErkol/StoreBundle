<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OptionValueType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('value', 'text', array(
                    'widget_control_group' => false,
                    'label_render' => false,
                    'attr' => array(
                        'placeholder' => 'Value'
                    )
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\OptionValue'
        ));
    }

    public function getName() {
        return 'kaan_corebundle_optionvaluetype';
    }

}
