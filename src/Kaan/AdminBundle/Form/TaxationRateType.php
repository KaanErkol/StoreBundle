<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaxationRateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('amount')
            ->add('category',null,array(
                'required' => true
            ))
            ->add('zone',null,array(
                'required' => true
            ))
            ->add('includePrice','checkbox',array(
                'required' => False,
                'label' => 'Include Price ?'
            ))

        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\TaxationRate'
        ));
    }

    public function getName()
    {
        return 'kaan_corebundle_taxationratetype';
    }
}
