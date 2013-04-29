<?php

namespace SICLA\HydraBundle\Controller;
use Sidus\SidusBundle\Controller\FolderController;

class ListController extends FolderController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAHydraBundle:Person:show.html.twig', $loaded_objects);
	}
}