<?php
 
namespace SICLA\AraBundle\Twig;
 
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Bundle\TwigBundle\Loader\FilesystemLoader;
 
class TwigExtension extends \Twig_Extension
{
    public function getFunctions()
    {
        return array(
            'call_user_func' => new \Twig_Function_Method($this, 'call_user_func', array('is_safe' => array('html')))
        );
    }
 
    public function call_user_func($entite, $critere='')
    {
        return \call_user_func(array($entite, $critere));
    }
 
    public function getName()
    {
        return 'sidusExtension';
    }
}