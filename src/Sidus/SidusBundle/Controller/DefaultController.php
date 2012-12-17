<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function indexAction(){
        return $this->render('SidusBundle:Default:index.html.twig');
    }

}
