<?php
namespace SICLA\AraBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class FamilleRechercheForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {        
        $builder->add('souhaitPublic', 'choice', array(
					'choices' => array(
						'Indifférent' => 'Indifférent',
						'Jeune' => 'Jeune',
						'Âge mûr' => 'Âge mûr',
					),
					'multiple' => false,
				));
    }
    
    public function getName()
    {        
        return 'famillerecherche';
    }
}
?>
