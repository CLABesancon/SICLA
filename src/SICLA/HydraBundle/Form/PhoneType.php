<?php

namespace SICLA\HydraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PhoneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('diallingCode')
            ->add('phoneNumber')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\HydraBundle\Entity\Phone',
			'cascade_validation' => true
        ));
    }

    public function getName()
    {
        return 'sicla_hydrabundle_phonetype';
    }
}
