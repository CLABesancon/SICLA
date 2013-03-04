<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

	public function homeAction() {
		// A récupérer : node 'root' (nodename);
		$em = $this->getDoctrine()->getManager();
		$node = $em->getRepository('SidusBundle:Node')->find(1);
		if (!$node) {
			return $this->forward('SidusBundle:Default:notFound');
		}
		return $this->render('SidusBundle:Default:home.html.twig', array('node' => $node));
	}

	public function notFoundAction() {
		$params = array('status_code' => 404, 'status_text' => 'Sorry, we were unable to find the requested node.');
		return $this->render('SidusBundle:Exception:error404.html.twig', $params)->setStatusCode(404);
	}

	public function noContentAction() {
		$params = array('status_code' => 418, 'status_text' => 'There seems to be no available content for this node.');
		return $this->render('SidusBundle:Exception:error418.html.twig', $params)->setStatusCode(418);
	}

	public function viewAction($id_node) {
		$em = $this->getDoctrine()->getManager();

		$node = $em->getRepository('SidusBundle:Node')->find($id_node);
		if (!$node) {
			return $this->forward('SidusBundle:Default:notFound');
		}

		//$ascendants = $node->getAscendants();
		//@TODO : Get permissions and compile

		$versions = $node->getLastVersions();
		if (!$versions) {
			return $this->forward('SidusBundle:Default:noContent');
		}

		$languages = array();
		foreach($versions as $version){
			$languages[$version->getLang()] = $version;
		}

		$lang = $this->getSession()->get('lang');
		if (!in_array($lang, $languages)) {
			$lang = $this->getRequest()->getPreferredLanguage(array_keys($languages));
			$this->getSession()->setFlash('warning', 'Sorry, this content is not available in your language.');
		}

		$node->setCurrentVersion($languages[$lang]);

		//@TODO : récupéré l'objet ET son type en une seule requête (Repo)
		$object = $node->getObject();
		$type = $object->getType();

		$response = $this->forward($object->getControllerPath() . ':view', array(
			'node' => $node,
			'object' => $object,
			'type' => $type,
		));

		return $response;
	}

	/**
	 * Get the current session or create a new one
	 * @return \Symfony\Component\HttpFoundation\Session\Session $session
	 */
	public function getSession() {
		$session = $this->getRequest()->getSession();
		if (!$session) {
			$session = new \Symfony\Component\HttpFoundation\Session\Session;
			$session->start();
		}
		return $session;
	}

}
