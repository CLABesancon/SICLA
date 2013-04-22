<?php

namespace SICLA\HydraBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SICLAHydraBundle:Default:index.html.twig', array('name' => $name));
    }
}
