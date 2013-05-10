<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\FolderController;

class FolderApprenantController extends FolderController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:FolderApprenant:show.html.twig', $loaded_objects);
	}
}

?>