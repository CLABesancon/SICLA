<?php

namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FamilleAccueilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dureeSejour')
             ->add('fumeur', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
			->add('adaptableRegimeAlimentaire', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('nbEnfants')
			->add('RegimeAlimentaire','entity', array(
				'class'    =>'SICLAAraBundle:RegimeAlimentaire',
				'property'=>'libelle',
				'multiple'=>false))
			->add('Loisirs','entity', array(
				'class'    =>'SICLAAraBundle:Loisir',
				'property'=>'libelle',
				'multiple' => true,
				'expanded' => true,
				'required'=>false))
			->add('animaux','entity', array(
				'class'    =>'SICLAAraBundle:TypeAnimal',
				'property'=>'libelle',
				'multiple' => true,
				'expanded' => true,
				'required'=>false))
			->add('nbLit')
			->add('ascenseur','choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\AraBundle\Entity\FamilleAccueil'
        ));
    }

    public function getName()
    {
        return 'sicla_arabundle_familleaccueiltype';
    }
}
