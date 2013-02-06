<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PageController extends Controller {
	
	public function viewAction($node,$object,$version){
		
		$em = $this->getDoctrine()->getManager();
		
		return $this->render('SidusBundle:Page:view.html.twig',array(
			'node'=>$node,
			'object'=>$object,
		));
	}
}