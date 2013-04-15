<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sidus\SidusBundle\Entity\Page;
use Sidus\SidusBundle\Entity\Version;

class PageController extends Controller {
	
	public function showAction($node,$object,$version,$type){
		
		$em = $this->getDoctrine()->getManager();
		
		return $this->render('SidusBundle:Page:show.html.twig',array(
			'node'=>$node,
			'object'=>$object,
			'type'=>$type,
		));
	}
	
	public function addAction($node, $_locale, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);

		$new_object = new Page();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setContent('');
		$new_object->setTags('');
		$em->persist($new_object);
		$em->flush();

		$new_version = new Version();
		$new_version->setNode($node);
		$new_version->setObject($new_object);
		$new_version->setLang($_locale);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		$em->persist($new_version);

		$em->flush();

		return $this->redirect($this->generateUrl('sidus_edit_node',array(
					'node_id' => $node->getId(),
					'_locale' => $_locale,
		)), 301 );
	}
}