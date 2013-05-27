<?php

namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AffectationDemandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			
			->add ('famille', 'entity', array(
				'class'    =>'SICLAAraBundle:FamilleAccueil',
				'property'=>'id',
				'multiple' => false))
			->add ('demande', 'entity', array(
				'class'    =>'SICLAAraBundle:ApprenantDemandeLogement',
				'property'=>'id',
				'multiple' => false))
			->add('dateArrivee', 'date', array(
				'input'  => 'datetime',
				'widget' => 'choice',
				'years' => range(2013,2020)))
			->add('dateDepart', 'date', array(
				'input'  => 'datetime',
				'widget' => 'choice',
				'years' => range(2013,2020)))
			;
		
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\AraBundle\Entity\AffectationDemande'
        ));
    }

    public function getName()
    {
        return 'sicla_arabundle_affectationdemandetype';
    }
}
