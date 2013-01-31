<?php

namespace Sidus\SidusBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('username')
            ->add('password')
            ->add('salt')
            ->add('email')
            ->add('expireAt')
            ->add('isInactive')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Sidus\SidusBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'sidusbundle_usertype';
    }
}
