<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Form\FolderType;

class FolderController extends Controller {

	public function showAction($loaded_objects) {
		return $this->render('SidusBundle:Folder:show.html.twig', $loaded_objects);
	}

	public function editAction($node, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new FolderType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			if ($form->isValid()) {
				//@TODO version
				$em->persist($object);
				$em->flush();
				return $this->forward('SidusBundle:Folder:show', $loaded_objects);
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

}