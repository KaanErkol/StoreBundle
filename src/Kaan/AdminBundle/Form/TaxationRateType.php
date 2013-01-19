<?php

namespace Kaan\CoreBundle\Form;

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
            ->add('includePrice')
            ->add('updatedAt')
            ->add('category')
            ->add('zone')
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
