<?php

namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FamilleAccueilType extends AbstractType {

	public function buildForm(FormBuilderInterface $builder, array $options) {
		$builder
				
				->add('debutDispo', 'date', array(
					'input' => 'datetime',
					'widget' => 'choice',
					'years' => range(2013, 2020)))
				->add('finDispo', 'date', array(
					'input' => 'datetime',
					'widget' => 'choice',
					'years' => range(2013, 2020)))
				->add('fumeur', 'choice', array(
					'choices' => array('1' => 'Oui', '0' => 'Non'),
					'expanded' => true,
					'multiple' => false))
				->add('nbEnfants')
				->add('nbLit')
				->add('ascenseur', 'choice', array(
					'choices' => array('1' => 'Oui', '0' => 'Non'),
					'expanded' => true,
					'multiple' => false))
				->add('souhaitNationalite', 'choice', array(
					'choices' => array(
						'A définir' => 'A définir',
					),
					'multiple' => false,
				))
				->add('typeAccueil', 'choice', array(
					'choices' => array(
						'Semi indépendance' => 'Semi indépendance',
						"Famille d'accueil" => "Famille d'accueil",
						
					),
					'multiple' => false,
				))
				->add('souhaitSexe', 'choice', array(
					'choices' => array(
						'Indifférent' => 'Indifférent',
						'Homme' => 'Homme',
						'Femme' => 'Femme',
					),
					'multiple' => false,
				))
				->add('souhaitPublic', 'choice', array(
					'choices' => array(
						'Indifférent' => 'Indifférent',
						'Jeune' => 'Jeune',
						'Âge mûr' => 'Âge mûr',
					),
					'multiple' => false,
				))
				->add('sdbPrivative', 'choice', array(
					'choices' => array('1' => 'Oui', '0' => 'Non'),
					'expanded' => true,
					'multiple' => false))
				->add('accesCuisine', 'choice', array(
					'choices' => array('1' => 'Oui', '0' => 'Non'),
					'expanded' => true,
					'multiple' => false))
				->add('conditionsAccesCuisine')
				->add('remarquesParticulieres')
				->add('ligneBus')
				->add('arretBus')
				->add('loyer')
				->add('charges')
				->add('remarquesServiceLogement')
				->add('RegimeAlimentaire', 'entity', array(
					'class' => 'SICLAAraBundle:RegimeAlimentaire',
					'property' => 'libelle',
					'multiple' => false))
				->add('adaptableRegimeAlimentaire', 'choice', array(
					'choices' => array('1' => 'Oui', '0' => 'Non'),
					'expanded' => true,
					'multiple' => false))
				->add('Loisirs', 'entity', array(
					'class' => 'SICLAAraBundle:Loisir',
					'property' => 'libelle',
					'multiple' => true,
					'expanded' => true,
					'required' => false))
				->add('animaux', 'entity', array(
					'class' => 'SICLAAraBundle:TypeAnimal',
					'property' => 'libelle',
					'multiple' => true,
					'expanded' => true,
					'required' => false))
				->add ('typeLogement', 'entity', array(
				'class'    =>'SICLAAraBundle:TypeLogement',
				'property'=>'libelle',
				'multiple'=>false))
		;
	}

	public function setDefaultOptions(OptionsResolverInterface $resolver) {
		$resolver->setDefaults(array(
			'data_class' => 'SICLA\AraBundle\Entity\FamilleAccueil'
		));
	}

	public function getName() {
		return 'sicla_arabundle_familleaccueiltype';
	}

}
