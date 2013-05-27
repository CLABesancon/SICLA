<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\FolderController;

class FolderAffectationDemandeController extends FolderController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:FolderAffectationDemande:show.html.twig', $loaded_objects);
	}
}

?>