<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Form\FolderType;
use Sidus\SidusBundle\Entity\Folder;
use Sidus\SidusBundle\Entity\Version;

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
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), '_locale' => $version->getLang())));
			}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SidusBundle:Folder:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $_locale, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);

		$new_object = new Folder();
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