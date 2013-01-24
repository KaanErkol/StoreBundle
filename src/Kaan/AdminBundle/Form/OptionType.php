<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kaan\AdminBundle\Form\OptionValueType;

class OptionType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('name')
                ->add('presentation')
                ->add('child', 'collection', array(
                    'type' => new OptionValueType(),
                    'allow_add' => true,
                    'label' => 'option.sub.value',
                    'allow_delete' => true,
                    'by_reference' => true,
                    'prototype' => true,
                    'widget_add_btn' => array('label' => "add now", 'attr' => array('class' => 'btn btn-primary')),
                    'show_legend' => false, // dont show another legend of subform
                    'options' => array(// options for collection fields
                        'label_render' => false,
                        'widget_control_group' => false,
                        'widget_remove_btn' => array('label' => "remove now", 'attr' => array('class' => 'btn')),
                        'attr' => array('class' => 'input-large'),
                    )
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\Option'
        ));
    }

    public function getName() {
        return 'kaan_corebundle_optiontype';
    }

}
