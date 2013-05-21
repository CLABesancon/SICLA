<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\FolderController;

class FolderFamilleAccueilController extends FolderController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:FolderFamilleAccueil:show.html.twig', $loaded_objects);
	}
}

?>