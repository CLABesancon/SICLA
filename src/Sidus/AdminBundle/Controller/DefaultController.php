<?php

namespace Sidus\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

	public function indexAction(){
		return $this->render('SidusAdminBundle:Default:index.html.twig');
	}

}
