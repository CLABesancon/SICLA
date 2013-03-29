<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class PageController extends Controller {
	
	public function showAction($node,$object,$version,$type){
		
		$em = $this->getDoctrine()->getManager();
		
		return $this->render('SidusBundle:Page:show.html.twig',array(
			'node'=>$node,
			'object'=>$object,
			'type'=>$type,
		));
	}
}