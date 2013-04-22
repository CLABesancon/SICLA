<?php

namespace SICLA\HydraBundle\Controller;
use Sidus\SidusBundle\Controller\CommonController;
use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Entity\Version;
use SICLA\HydraBundle\Form\PersonType;
use SICLA\HydraBundle\Entity\Person;

class PersonController extends CommonController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAHydraBundle:Person:show.html.twig', $loaded_objects);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new PersonType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			if ($form->isValid()) {
				//@TODO version
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), '_locale' => $version->getLang())));
			}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAHydraBundle:Person:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $_locale, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);

		$new_object = new Person();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setFirstName('');
		$new_object->setLastName('');
		$new_object->setMaidenName('');
		$new_object->setGender('');
		
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
	public function form_personAction(Request $request){
		$person=new Person();
		$form=$this->createForm(new PersonType(), $person);
		
		$em = $this->getDoctrine()->getEntityManager();
		
		
		if ($request->isMethod('POST')) {
			$form->bind($this->getRequest());
			$person = $form->getData();
			$em->persist($person);
			$em->flush();
		}
		return $this->render('SICLAHydraBundle:Form:form_person.html.twig', array('form'=>$form->createView()));
	}*/
}