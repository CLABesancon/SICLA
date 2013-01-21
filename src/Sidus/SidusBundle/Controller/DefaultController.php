<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

	public function viewAction($node) {
		$id_node = null;
		$slug = null;
		if (is_numeric($node)) {
			$id_node = $node;
		} else if (is_string($node)) {
			$slug = $node;
		} else {
			return $this->render('SidusBundle:Default:error.html.twig', array('id_node' => $id_node));
		}

		return $this->render('SidusBundle:Default:view.html.twig', array('id_node' => $id_node, 'slug' => $slug));
	}

}
