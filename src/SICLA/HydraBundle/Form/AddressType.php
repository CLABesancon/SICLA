<?php

namespace SICLA\HydraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AddressType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('streetNumber')
            ->add('streetNumberSuffix')
			->add('streetType', 'choice', array(
					'choices'   => array(
						'-'   => '-',
						'Allée'   => 'Allée',
						'Avenue' => 'Avenue',
						'Boulevard'   => 'Boulevard',
						'Chemin'   => 'Chemin',
						'Impasse'   => 'Impasse',
						'Place'   => 'Place',
						'Rue'   => 'Rue',
						'Route'   => 'Route',
						'Voie'   => 'Voie',
						
					),
					'multiple'  =>false,
				))
            ->add('streetName')
            ->add('addressType')
            ->add('addressTypeNumber')
            ->add('minorMunicipality')
            ->add('majorMunicipality')
            ->add('governinsDistrict')
            ->add('postalCode')
            ->add('country')
            ->add('cedex')
            ->add('cedexNumber')
            ->add('postofficeNumber')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\HydraBundle\Entity\Address'
        ));
    }

    public function getName()
    {
        return 'sicla_hydrabundle_addresstype';
    }
}
