<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Form\FolderType;

class FolderController extends Controller {

	public function showAction($version) {
		return $this->render('SidusBundle:Folder:show.html.twig', array('version' => $version, 'node' => $version->getNode(), 'object' => $version->getObject()));
	}

	public function editAction($node, Request $request) {
		$form = $this->createForm(new FolderType(), $node['object']);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			if ($form->isValid()) {
				//@TODO version
				$em->persist($node['object']);
				$em->flush();
				return $this->forward('SidusBundle:Folder:show', array(
							'node' => $node,
				));
			}
		}

		return $this->render('SidusBundle:Folder:edit.html.twig', array(
					'form' => $form->createView(),
					'node' => $node,
		));
	}

	public function addAction($node, Request $request) {

		return $this->render('SidusBundle:Folder:add.html.twig', array(
					'node' => $node,
		));
	}

}