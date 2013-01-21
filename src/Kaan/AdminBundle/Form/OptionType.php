<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Kaan\AdminBundle\Form\OptionValueType;
class OptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('presentation')
            ->add('child','collection', array( 'type' =>  new OptionValueType(),
                                              'allow_add' => true,
                                              'allow_delete' => true,
                                              'by_reference' => true,
                                              ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\Option'
        ));
    }

    public function getName()
    {
        return 'kaan_corebundle_optiontype';
    }
}
