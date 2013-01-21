<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username','text',array(
            'label' => 'Kullanıcı Adı',
        ))

            ->add('email')
            ->add('UserRoles','entity',array(
                'class' => 'UserBundle:Role',
                'property'     => 'name',
                'multiple' => true,
                'attr' => array(
                    'class' => 'chosen'
                )
            ))
            ->add('password', 'repeated', array (
                'label' => 'Password',
                'type'            => 'password',
                'first_name'      => "Password",
                'second_name'     => "Password-Confirm",
                'second_options'  => array('label'=>'Re Password'),
                'invalid_message' => "The passwords don't match!",
                'required' => FALSE
            ));
    }


    public function getName()
    {
        return 'kaan_testbundle_usertype';
    }
}