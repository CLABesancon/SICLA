<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Form\FolderType;

class FolderController extends Controller {

	public function showAction($loaded_objects) {
		return $this->render('SidusBundle:Folder:show.html.twig', $loaded_objects);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new FolderType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			if ($form->isValid()) {
				//@TODO version
				$em->persist($object);
				$em->flush();
				$this->getSession()->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNodeId(), '_locale' => $version->getLang())));
			}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SidusBundle:Folder:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, Request $request) {

		return $this->render('SidusBundle:Folder:add.html.twig', array(
					'node' => $node,
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