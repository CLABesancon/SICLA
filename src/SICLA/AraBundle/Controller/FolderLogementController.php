<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\FolderController;

class FolderLogementController extends FolderController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:FolderLogement:show.html.twig', $loaded_objects);
	}
}

?>