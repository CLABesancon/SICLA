<?php

namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use SICLA\HydraBundle\Form\AddressType;

class LogementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('meuble','choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))
			->add('surface')
			->add('nbChambres')
			->add('consommationEnergie')
			->add('emissionGes')
			->add('loyer')
			->add('echeanceLoyer','choice', array(
			  'choices' => array('semaine' => 'Paiement à la semaine', 'mois' => 'Paiement au mois'),
			  'expanded' => true,
			  'multiple' => false))
			->add('charges')
			->add('ascenseur','choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))
			->add('sdbPrivative','choice', array(
			  'choices' => array('1' => 'Oui', '0' => 'Non'),
			  'expanded' => true,
			  'multiple' => false))
			->add ('equipement', 'entity', array(
				'class'    =>'SICLAAraBundle:Equipement',
				'property'=>'libelle',
				'multiple' => true,
				'expanded' => true))
			 ->add ('typeLogement', 'entity', array(
				'class'    =>'SICLAAraBundle:TypeLogement',
				'property'=>'libelle',
				'multiple'=>false))
			->add('address', new AddressType());
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\AraBundle\Entity\Logement'
        ));
    }

    public function getName()
    {
        return 'arabundle_logementtype';
    }
}
