<?php

namespace Kaan\UserBundle\Form\Type;

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
            'attr' => array(
                'append_input'=>'<i class="icon-user"></i>'
            )
        ))

            ->add('email','email')
            ->add('password', 'repeated', array (
                'label' => 'Password',
                'type'            => 'password',
                'first_name'      => "Password",
                'second_name'     => "Password-Confirm",
                'second_options'  => array('label'=>'Re Password'),
                'invalid_message' => "The passwords don't match!",
            ));
    }


    public function getName()
    {
        return 'kaan_testbundle_usertype';
    }
}