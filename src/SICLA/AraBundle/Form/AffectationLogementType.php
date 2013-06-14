<?php

namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AffectationLogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
			->add ('demande', 'entity', array(
				'class'    =>'SICLAAraBundle:ApprenantDemandeLogement',
				'property'=>'id',
				'multiple' => false))
			->add ('logement', 'entity', array(
				'class'    =>'SICLAAraBundle:Logement',
				'property'=>'title',
				'multiple' => false))	
			->add('dateArrivee')
			->add('dateDepart');
		
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\AraBundle\Entity\AffectationLogement'
        ));
    }

    public function getName()
    {
        return 'sicla_arabundle_affectationlogementtype';
    }
}
