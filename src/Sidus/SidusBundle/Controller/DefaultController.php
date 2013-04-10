<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sidus\SidusBundle\Entity\Node;

class DefaultController extends Controller {

	protected $loaded_objects = array();
	protected $versions;
	protected $version;
	protected $ascendants;
	protected $siblings;
	protected $children;

	public function loginAction() {
		if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
			return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => 1)));
		}
		$request = $this->getRequest();
		$session = $request->getSession();
		if ($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)) {
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		} else {
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}

		return $this->render('SidusBundle:User:login.html.twig', array(
					'last_username' => $session->get(SecurityContext::LAST_USERNAME),
					'error' => $error,
		));
	}

	/**
	 *
	 * @param type $node_id
	 * @return type
	 */
	public function homeAction() {
		$version = $this->getVersionByNodeUID('home');

		if (null === $version) {
			$em = $this->getDoctrine()->getManager();
			$core_nodes = $em->getRepository('SidusBundle:Node')->getRootNodes();
			var_dump($core_nodes);
			//TODO
		}

		$controller = $version->getObject()->getType()->getController();
		if ($controller) {
			return $this->forward($controller.':show', array('version' => $version));
		}

		return $this->render('SidusBundle:Default:show.html.twig', array('version' => $version, 'node' => $version->getNode(), 'object' => $version->getObject()));
	}

	public function notFoundAction() {
		//@TODO traduction
		$params = array('status_code' => 404, 'status_text' => 'Sorry, we were unable to find the requested node.');
		return $this->render('SidusBundle:Exception:error404.html.twig', $params)->setStatusCode(404);
	}

	/**
	 *
	 * @param type $node_id
	 * @return type
	 */
	public function showAction($node_id, $_locale = null) {
		$this->loadObjectsForNodeUID($node_id, $_locale);

		if (null === $this->version) {
			return $this->forward('SidusBundle:Default:notFound');
		}

		$controller = $this->version->getObject()->getType()->getController();
		if ($controller) {
			return $this->forward($controller.':show', $this->loaded_objects);
		}

		return $this->render('SidusBundle:Default:show.html.twig', $this->loaded_objects);
	}

	public function editAction($node_id) {
		$version = $this->getVersionByNodeId($node_id);

		if (null === $version) {
			return $this->forward('SidusBundle:Default:notFound');
		}

		$controller = $version->getObject()->getType()->getController();
		if ($controller) {
			return $this->forward($controller.':edit', array('version' => $version));
		}

		return $this->render('SidusBundle:Default:edit.html.twig', array('version' => $version, 'node' => $version->getNode(), 'object' => $version->getObject()));
	}

	public function chooseAction($node_id) {
		/** @TODO Lorsqu'on clique sur une des icones -> forward vers addAction du type en question.
		 */
		$node = $this->getNode($node_id);

		$em = $this->getDoctrine()->getManager();

		$forbidden_types = $node['object']->getType()->getForbiddenTypes();
		$authorized_types = $node['object']->getType()->getAuthorizedTypes();

		if (!$forbidden_types->isEmpty()) {
			$types = new \Doctrine\Common\Collections\ArrayCollection($em->getRepository('SidusBundle:Type')->findAll());
			foreach ($forbidden_types->toArray() as $type) {
				$types->removeElement($type);
			}
		}
		if (!$authorized_types->isEmpty()) {
			$types = $authorized_types;
		}

		if ($this->getRequest()->isMethod('POST')) {
			// $this->getRequest()->request->keys() -> récupère le name du submit selectionner $type[0].':add', array('node' => $node,));
			$type = $this->getRequest()->request->keys();

			$user = $em->getRepository('SidusBundle:Node')->find(11);

			$new_node = new Node();
			$new_node->setParent($node['node']);
			$new_node->setCreatedBy($user);
			$new_node->setNodename('');
			$em->persist($new_node);
			$em->flush();
			//Créer une nouvelle node + version + objet (et type) et forward vers edit de la node nouvellement créer)

			return $this->redirect($this->generateUrl('sidus_add_node', array(
								'_locale' => $node['node']->getCurrentVersion()->getLang(),
								'node_id' => $new_node->getId(),
			)));
		}

		return $this->render('SidusBundle:Default:choose.html.twig', array(
					'node' => $node,
					'types' => $types,
		));
	}



	protected function loadObjectsForNodeUID($node_uid, $lang = null) {
		$this->loadVersionsForNodeId($node_uid);
		$this->version = $this->chooseBestVersion($this->versions, $lang);
		if (null === $this->version) {
			return;
		}
		$this->loadAscendants($this->version->getNode());
		$this->loadChildren($this->version->getNode());
		$this->loadSiblings($this->version->getNode());
		$this->loaded_objects = array(
			'versions' => $this->versions,
			'version' => $this->version,
			'node' => $this->version->getNode(),
			'object' => $this->version->getObject(),
			'ascendants' => $this->ascendants,
			'children' => $this->children,
			'siblings' => $this->siblings,
		);
		$this->loaded_objects['loaded_objects'] = $this->loaded_objects;
	}

	protected function loadVersionsForNodeId($node_id, $lang = null) {
		$em = $this->getDoctrine()->getManager();

		if (is_numeric($node_id)) {
			$versions = $em->getRepository('SidusBundle:Version')->findByNodeId($node_id);
		} else {
			$versions = $em->getRepository('SidusBundle:Version')->findByNodeName($node_id);
		}

		$this->versions = $versions;
		return $versions;
	}

	protected function chooseBestVersion(array $versions, $lang = null) {
		if (empty($versions)) {
			return null;
		}

		$available_languages = array();
		foreach ($versions as $version) {
			if ($version->getLang() === $lang) {
				return $version;
			}
			$available_languages[$version->getLang()] = $version;
		}

		$best_language_match = $this->getRequest()->getPreferredLanguage(array_keys($available_languages));
		$version = $available_languages[$best_language_match];

		if (null !== $lang || $best_language_match !== substr($this->getRequest()->getPreferredLanguage(), 0, 2)) {
			//@TODO traduction
			$this->getSession()->setFlash('warning', 'Sorry, this content is not available in your language.');
		}
		return $version;
	}

	protected function loadAscendants(Node $node, $lang = null){
		$em = $this->getDoctrine()->getManager();
		$ascendants = $node->getAscendants();
		$ascendant_ids = array();
		foreach ($ascendants as $ascendant){
			$ascendant_ids[] = $ascendant->getId();
		}
		$versions = $em->getRepository('SidusBundle:Version')->findByNodeIds($ascendant_ids);
		$node_ascendants = array();
		foreach($versions as $version){
			$node_ascendants[$version->getNodeId()][$version->getLang()] = $version;
		}
		$ascendants = array();
		foreach($node_ascendants as $ascendant_versions){
			$ascendants[] = $this->chooseBestVersion($ascendant_versions, $lang);
		}
		$this->ascendants = $ascendants;
		return $ascendants;
	}

	protected function loadChildren(Node $node, $lang = null){
		$em = $this->getDoctrine()->getManager();
		$versions = $em->getRepository('SidusBundle:Version')->findByParentNodeId($node->getId());
		$node_children = array();
		foreach($versions as $version){
			$node_children[$version->getNodeId()][$version->getLang()] = $version;
		}
		$children = array();
		foreach($node_children as $child_versions){
			$children[] = $this->chooseBestVersion($child_versions, $lang);
		}
		$this->children = $children;
		return $children;
	}

	protected function loadSiblings(Node $node, $lang = null){
		$em = $this->getDoctrine()->getManager();
		$versions = $em->getRepository('SidusBundle:Version')->findByParentNodeId($node->getParentId());
		$node_siblings = array();
		foreach($versions as $version){
			$node_siblings[$version->getNodeId()][$version->getLang()] = $version;
		}
		$siblings = array();
		foreach($node_siblings as $sibling_versions){
			$siblings[] = $this->chooseBestVersion($sibling_versions, $lang);
		}
		$this->siblings = $siblings;
		return $siblings;
	}

	public function addAction($node, $ascendants, $descendants, $object) {
		/* @TODO récupérer la liste des types autorisés (white list) ou de tout les types moins ceux interdit (black list)
		  ->Comment différencier white/black list?
		 * afficher les icones des types ajoutables (include Resources/shows/{type}/icon.html.twig
		 * Lorsqu'on clique sur une des icones -> forward vers addAction du type en question.
		 */
		return $this->render('SidusBundle:Default:add.html.twig', array(
					'node' => $node,
					'ascendants' => $ascendants,
					'descendants' => $descendants,
					'object' => $object,
		));
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
			$session->set('lang', $this->getRequest()->getLocale());
		}
		return $session;
	}

}
