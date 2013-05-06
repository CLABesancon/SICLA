<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\FolderController;

class AnnoncesController extends FolderController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $loaded_objects);
	}
}

?>