<?php

namespace Sidus\SidusBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Mopa\Bundle\BootstrapBundle\Navbar\NavbarFormInterface;

class SearchFormType extends AbstractType implements NavbarFormInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->setAttribute('render_fieldset', false)
            ->setAttribute('label_render', false)
            ->setAttribute('show_legend', false)
            ->add('search', 'text', array(
                'widget_control_group' => false,
                'widget_controls' => false,
                'attr' => array(
                    'placeholder' => "search",
                    'class' => "input-medium search-query"
                )
            ))
        ;
    }
    public function getName()
    {
        return 'sidus_search';
    }
    /**
     * To implement NavbarFormTypeInterface
     */
    public function getRoute()
    {
        return "sidus_welcome"; # return here the name of the route the form should point to
    }
}