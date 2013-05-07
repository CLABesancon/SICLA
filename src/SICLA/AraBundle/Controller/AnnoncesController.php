<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\FolderController;
use Knp\Component\Pager\Paginator;

class AnnoncesController extends FolderController {
	
	public function showAction($loaded_objects) {
		
		$paginator =new Paginator();
		$em = $this->getDoctrine()->getEntityManager();
		$qb=$em->getRepository('SidusBundle:Version')->getQueryBuilder();
		$result=$qb->getQuery()->getResult();
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $loaded_objects);
	}
}

?>