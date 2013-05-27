<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Entity\AffectationDemande;
use SICLA\AraBundle\Form\AffectationDemandeType;

class AffectationDemandeController extends CommonController
{
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:AffectationDemandes:show.html.twig', $loaded_objects);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		
		$form = $this->createForm(new AffectationDemandeType(), $object);
		$em = $this->getDoctrine()->getEntityManager();
		$familles = $em->getRepository('SICLAAraBundle:FamilleAccueil')->findFamillesDispo();
		$demandes = $em->getRepository('SICLAAraBundle:ApprenantDemandeLogement')->findAll();
		if ($request->isMethod('POST')) {
		
		//if ($form->isValid()) {
				$object->setTitle('');
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
				//} 
		}
		$loaded_objects['familles']=$familles;
		$loaded_objects['demandes']=$demandes;
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:AffectationDemandes:edit.html.twig', $loaded_objects);
	}
	
	public function addAction($node, $lang, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);
		$new_object = new AffectationDemande();
		$new_object->setType($type);
		$new_object->setTitle('');

		
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

?>
	