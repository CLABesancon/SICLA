<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller {


	public function homeAction(){
		// A récupérer : node 'root' (nodename);
		return $this->render('SidusBundle:Default:home.html.twig');
	}

	public function notFoundAction(){
		$params = array('status_code' => 404, 'status_text' => 'Sorry, we were unable to find the requested node.');
		return $this->render('SidusBundle:Exception:error404.html.twig', $params)->setStatusCode(404);
	}

	public function viewAction($id_node) {
		
		//@TODO : Récupérer la langue depuis la locale en session (setter via la route spéciale _locale)
		$lang='en';

		$em = $this->getDoctrine()->getManager();

		$node = $em->getRepository('SidusBundle:Node')->find($id_node);
		if (!$node) {
			//@TODO : Redirect to last visited node (stored in session ?) instead of forwarding.
			$response = $this->forward('SidusBundle:Default:notFound');
		}else{
			$parents = $node->getParents();
			//@TODO : Get permissions and compile
			//$versions = $em->getRepository('SidusBundle:Version')->findByNode($node);
			$last_version = $em->getRepository('SidusBundle:Version')->findLastVersion($node,$lang);
			if(!$last_version){
				//Version not found
				$this->get('session')->setFlash('error','We are sorry, we cannot found a node according to the lang you are looking for.');
				//@TODO : Redirect to last visited node (stored in session ?) instead of forwarding -> catch 418
				$response = $this->forward('SidusBundle:Default:home');
			}else{
				//@TODO : récupéré l'objet ET son type en une seule requête (Repo)
				$object = $last_version->getObject();
				$type = $object->getType();
				
				$response = $this->forward($object->getControllerPath().':view', array(
					'node'		=>$node,
					'object'	=>$object,
					'type'		=>$type,
					'version'	=>$last_version,
				));
			}
		}

		return $response;
	}

}
