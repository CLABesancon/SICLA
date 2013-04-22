<?php

namespace SICLA\AraBundle\Controller;

use SICLA\AraBundle\Entity\Liste;
use SICLA\AraBundle\Form\ListeType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;

class ListeController extends Controller {

	public function tri($objetsActuels, $entity) {
		$em = $this->getDoctrine()->getEntityManager();
		$aSuppr = new ArrayCollection($this->getDoctrine()->getRepository($entity)->findAll());

		foreach ($objetsActuels as $objet) {
			if ($aSuppr->contains($objet)) {
				$aSuppr->removeElement($objet);
			} else {
				$em->persist($objet);
			}
		}
		foreach ($aSuppr as $objet) {
			$em->remove($objet);
		}
	}

	public function viewAction(Request $request) {
		$liste = new Liste();
		$entites = $liste->getEntites();


		foreach ($entites as $key => $value) {
			$objet = $this->getDoctrine()->getRepository($value['entity'])->findall();
			$collectionObjets = new ArrayCollection($objet);
			$method = 'set'.ucfirst($key);
			$liste->$method($collectionObjets);
		}

		$form = $this->createForm(new ListeType(), $liste);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			$list = $form->getData();
			foreach ($entites as $key => $value) {
				$method = 'get'.ucfirst($key);
				$this->tri($list->$method()->getValues(), $value['entity']);
			}
			$em->flush();
		}

		return $this->render('SICLAAraBundle:Liste:new.html.twig', array(
					'form' => $form->createView(), 'entites'=>$entites
		));
	}

}

?>
