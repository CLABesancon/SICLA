<?php

namespace SICLA\HydraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PersonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
			->add('gender', 'choice', array(
					'choices'   => array(
						'-'   => '-',
						'homme'   => 'Homme',
						'femme' => 'Femme'
					),
					'multiple'  =>false,
			))
            ->add('maidenName')
            ->add('birthday')
				
			  ->add('phones','collection', array(
                'type' => new PhoneType(),
                'allow_add' => true,
                'allow_delete' => true, // should render default button, change text with widget_remove_btn
                'prototype' => true,
                'widget_add_btn' => array('label' => "Ajouter", 'attr' => array('class' => 'btn btn-primary')),
                'show_legend' => false, // dont show another legend of subform
                'options' => array( // options for collection fields
                    'label_render' => false,
                    'widget_control_group' => false,
                    'widget_remove_btn' => array('label' => "Supprimer", 'attr' => array('class' => 'btn')),
                    'attr' => array('class' => 'input-large'),
                )
            ))
				->add('addresses','collection', array(
                'type' => new AddressType(),
                'allow_add' => true,
                'allow_delete' => true, // should render default button, change text with widget_remove_btn
                'prototype' => true,
                'widget_add_btn' => array('label' => "Ajouter", 'attr' => array('class' => 'btn btn-primary')),
                'show_legend' => false, // dont show another legend of subform
                'options' => array( // options for collection fields
                    'label_render' => false,
                    'widget_control_group' => false,
                    'widget_remove_btn' => array('label' => "Supprimer", 'attr' => array('class' => 'btn')),
                    'attr' => array('class' => 'input-large'),
                )
            ))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\HydraBundle\Entity\Person'
        ));
    }

    public function getName()
    {
        return 'sicla_hydrabundle_persontype';
    }
}
