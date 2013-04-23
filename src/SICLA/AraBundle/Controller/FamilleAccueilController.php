<?php

namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Form\FamilleAccueilType;
use SICLA\AraBundle\Entity\FamilleAccueil;


class FamilleAccueilController extends CommonController {
	
	
	 public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:FamilleAccueil:show.html.twig', $loaded_objects);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new FamilleAccueilType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			//if ($form->isValid()) {
				//@TODO version
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), '_locale' => $version->getLang())));
			//}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:FamilleAccueil:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $_locale, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);
		
		$regimeAlimentaire=$em->getRepository('SICLAAraBundle:RegimeAlimentaire')->find(1);
		
		$new_object = new FamilleAccueil();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setDureeSejour('');
		$new_object->setFumeur('');
		$new_object->setRegimeAlimentaire($regimeAlimentaire);
		$new_object->setAdaptableRegimeAlimentaire('');
		$new_object->setNbEnfants('');
		$new_object->setNbLit('');
		$new_object->setAscenseur('');
		
		$em->persist($new_object);
		$em->flush();

		$new_version = new Version();
		$new_version->setNode($node);
		$new_version->setObject($new_object);
		$new_version->setLang($_locale);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		$em->persist($new_version);

		$em->flush();

		return $this->redirect($this->generateUrl('sidus_edit_node',array(
					'node_id' => $node->getId(),
					'_locale' => $_locale,
		)), 301 );
	}

/*
	public function form_famille_accueilAction(Request $request) {
		$form = $this->createForm(new FamilleAccueilType());

		$em = $this->getDoctrine()->getEntityManager();

		$form->bind($this->getRequest());

		if ($request->isMethod('POST')) {

			$famille = $form->getData();
			$em->persist($famille);
			$em->flush();
		}

		return $this->render('SICLAAraBundle:Form:form_famille_accueil.html.twig', array('form' => $form->createView()));
	}
	public function view_form_famille_accueilAction($id,Request $request)
    {
		$famille=$this->getDoctrine()->getRepository('SICLAAraBundle:FamilleAccueil')->find($id);
		$form = $this->createForm(new FamilleAccueilType(),$famille);
		
		$em = $this->getDoctrine()->getEntityManager();
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
			$famille = $form->getData();
			$em->flush();
		}
		
		return $this->render('SICLAAraBundle:Form:view_famille_accueil.html.twig', array('logement' => $famille, 'form' => $form->createView()));
	}*/


}

?>
	