<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller {
	
	
	public function homeAction(){
		// A récupérer : node d'id 1;
		return $this->render('SidusBundle:Default:home.html.twig');
	}
	
	public function viewAction($id_node) {
		
		//Récupérer la langue depuis la locale en session (setter via la route spéciale _locale)
		$lang='en';
		
		$em = $this->getDoctrine()->getManager();
		
		$node = $em->getRepository('SidusBundle:Node')->find($id_node);
		if (!$node) {
			//Node not found.
			$this->get('session')->setFlash('error','We are sorry, we cannot found the node you are looking for.');
			//@TODO : Redirect to last visited node (stored in session ?) instead of forwarding.
			$response = $this->forward('SidusBundle:Default:home');
		}else{
			$parents = $node->getParents();
			//@TODO : Get permissions and compile
			//$versions = $em->getRepository('SidusBundle:Version')->findByNode($node);
			$last_version = $em->getRepository('SidusBundle:Version')->findLastVersion($node,$lang);
			if(!$last_version){
				//Version not found
				$this->get('session')->setFlash('error','We are sorry, we cannot found a node according to the lang you are looking for.');
				//@TODO : Redirect to last visited node (stored in session ?) instead of forwarding.
				$response = $this->forward('SidusBundle:Default:home');
			}else{
				$object = $last_version->getObject();
		
				$response = $this->forward($object->getControllerPath().':view', array(
					'node'		=>$node,
					'object'	=>$object,
					'version'	=>$last_version,
				));
			}
		}
		
		return $response;
	}

}
