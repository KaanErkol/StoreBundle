<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('city')
            ->add('postcode')
            ->add('adress')
            ->add('phone')
            ->add('shippingname')
            ->add('country')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\Adress'
        ));
    }

    public function getName()
    {
        return 'kaan_corebundle_adresstype';
    }
}
