<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\FolderController;

class FolderAnnonceValideeController extends FolderController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:FolderAnnonceValidee:show.html.twig', $loaded_objects);
	}
}

?>