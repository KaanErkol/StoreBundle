<?php

namespace Kaan\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TaxonomiesType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options) {
        $builder
                ->add('title', 'text', array(
                    'required' => TRUE
                ))
                ->add('parent', 'entity', array(
                    'class' => 'CoreBundle:Taxonomies',
                    'query_builder' => function($er) {
                        return $er->createQueryBuilder('t')
                                ->orderBy('t.root', 'ASC')
                                ->addOrderBy('t.lft', 'ASC');
                    },
                    'property' => 'indentedTitle',
                    'required' => false,
                    'attr' => array('class' => 'chosen')
                ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver) {
        $resolver->setDefaults(array(
            'data_class' => 'Kaan\CoreBundle\Entity\Taxonomies'
        ));
    }

    public function getName() {
        return 'kaan_appbundle_taxonomiestype';
    }

}
