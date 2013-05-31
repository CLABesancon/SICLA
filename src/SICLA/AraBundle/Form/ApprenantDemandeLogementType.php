<?php

namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ApprenantDemandeLogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add('nom')
			->add('prenom')
			->add('mail')
			->add('adresse')
			->add('tel')
			->add('ddn', 'date', array(
					'input' => 'datetime',
					'widget' => 'choice',
					'years' => range(1920, 2020)))		
			->add('situationMaritale', 'choice', array(
					'choices' => array(
						'Célibataire' => 'Célibataire',
						"Marié" => "Marié",
						"Divorcé" => "Divorcé",
						"Veuf" => "Veuf"
					),
					'multiple' => false,
				))	
			->add('pays')
			->add('debutantFrancais', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))
			->add('nomFormation')	
			->add('typeHebergement', 'choice', array(
					'choices' => array(
						'Semi indépendance' => 'Semi indépendance',
						"Famille d'accueil" => "Famille d'accueil",
						"Logement" => "Logement",
						
					),
					'multiple' => false,
				))
			->add('regimeAlimentaire', 'entity', array(
					'class' => 'SICLAAraBundle:RegimeAlimentaire',
					'property' => 'libelle',
					'multiple' => false))	
			->add('debutFormation', 'date', array(
					'input' => 'datetime',
					'widget' => 'choice',
					'years' => range(2013, 2020)))
			->add('finFormation', 'date', array(
					'input' => 'datetime',
					'widget' => 'choice',
					'years' => range(2013, 2020)))	
			->add('handicapPhysique', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))
            ->add('detailHandicap', 'textarea', array('required' => false))
			->add('traitementMedical', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('detailTraitement', 'textarea', array('required' => false))
			->add('allergiesAnimaux', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('detailAllergiesAnimaux', 'textarea', array('required' => false))
            ->add('allergiesAlimentaires', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('detailAllergiesAlimentaires', 'textarea', array('required' => false))
            ->add('allergiesAutres', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('detailAllergiesAutres', 'textarea', array('required' => false))
            ->add('fumeur', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('tolerantFumee', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('vehicule', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))
			->add('voeuxPersonnels', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('detailVoeuxPersonnels', 'textarea', array('required' => false))
			->add('loisirsParticuliers', 'choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))	
            ->add('detailLoisirsParticuliers', 'textarea', array('required' => false))
			->add('Loisirs','entity', array(
				'class'    =>'SICLAAraBundle:Loisir',
				'property'=>'libelle',
				'multiple' => true,
				'expanded' => true,
				'required'=>false))
			->add('groupeApprenants','entity', array(
				'class'    =>'SICLAAraBundle:GroupeApprenants',
				'property'=>'libelle',
				'multiple' => true,
				'expanded' => true,
				'required'=>false))	
			->add('idStagiaire')
			->add('nbPersonne')
			->add('nbLit')	
			->add('loyerMax')
			;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\AraBundle\Entity\ApprenantDemandeLogement'
        ));
    }

    public function getName()
    {
        return 'sicla_arabundle_apprenantdemandelogementtype';
    }
}
