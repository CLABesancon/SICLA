<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\FolderController;

class PetitesAnnoncesController extends FolderController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:PetitesAnnonces:show.html.twig', $loaded_objects);
	}
}

?>