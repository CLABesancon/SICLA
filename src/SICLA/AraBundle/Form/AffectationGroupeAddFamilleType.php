<?php

namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AffectationGroupeAddFamilleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add ('famille', 'entity', array(
				'class'    =>'SICLAAraBundle:FamilleAccueil',
				'property'=>'id',
				'multiple' => false))
			->add ('statutFamille', 'entity', array(
				'class'    =>'SICLAAraBundle:StatutFamille',
				'property'=>'libelle',
				'multiple' => false))		
			->add('dateArrivee')
			->add('dateDepart');
		
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\AraBundle\Entity\AffectationGroupe'
        ));
    }

    public function getName()
    {
        return 'sicla_arabundle_affectationgroupetype';
    }
}
