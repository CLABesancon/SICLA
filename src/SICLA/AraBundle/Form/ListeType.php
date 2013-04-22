<?php
namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ListeType extends AbstractType
{
	 public function buildForm(FormBuilderInterface $builder, array $options)
    {
		
		 $builder->add('animaux', 'collection', array(
				'type' => new TypeAnimalType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
		))
				->add('logements', 'collection', array(
				'type' => new TypeLogementType(),
				'allow_add' => true,
				'allow_delete' => true,
				'by_reference' => false,
					
		))
				->add('regimes', 'collection', array(
					'type' => new RegimeAlimentaireType(),
					'allow_add' => true,
					'allow_delete' => true,
					'by_reference' => false,
		))
				->add('loisirs', 'collection', array(
					'type' => new LoisirType(),
					'allow_add' => true,
					'allow_delete' => true,
					'by_reference' => false,
		))
			->add('equipements', 'collection', array(
					'type' => new EquipementType(),
					'allow_add' => true,
					'allow_delete' => true,
					'by_reference' => false,
		));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'SICLA\AraBundle\Entity\Liste',
        ));
    }

    public function getName()
    {
        return 'task';
    }
}
?>
