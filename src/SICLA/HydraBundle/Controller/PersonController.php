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
			//if ($form->isValid()) {
				//@TODO version
				$object->setTitle($object->getFirstName().' '.$object->getLastName());
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
			//}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAHydraBundle:Person:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $lang, $type) {

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
		$new_version->setLang($lang);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		$em->persist($new_version);

		$em->flush();

		return $this->redirect($this->generateUrl('sidus_edit_node',array(
					'node_id' => $node->getId(),
					'lang' => $lang,
		)), 301 );
	}
}