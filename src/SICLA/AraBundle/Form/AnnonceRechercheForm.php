<?php
namespace SICLA\AraBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class AnnonceRechercheForm extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {        
        $builder->add('surface', 'text', array('label' => 'Surface'));
    }
    
    public function getName()
    {        
        return 'annoncerecherche';
    }
}
?>
