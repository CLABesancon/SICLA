<?php

namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Form\FamilleAccueilType;
use SICLA\AraBundle\Entity\FamilleAccueil;
use Sidus\SidusBundle\Entity\Node;


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
		$node_parent=$loaded_objects['node']->getParent()->getId();
		$this->loadObjectsForNodeUID($node_parent, $lang=null);
		//$object->setTitle('Famille '.$this->loaded_objects['object']->getFirstName());
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
			//}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:FamilleAccueil:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $lang, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);
		
			
		$new_object = new FamilleAccueil();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setFumeur('');
		$new_object->setAdaptableRegimeAlimentaire('');
		$new_object->setNbEnfants('');
		$new_object->setNbLit('');
		$new_object->setAscenseur('');
		$new_object->setAccesCuisine('');
		$new_object->setSdbPrivative('');
		$new_object->setConditionsAccesCuisine('');
		$new_object->setRemarquesParticulieres('');
		$new_object->setRemarquesServiceLogement('');
		$new_object->setLigneBus('');
		$new_object->setArretBus('');
		$new_object->setLoyer('');
		$new_object->setCharges('');
		$new_object->setSouhaitNationalite('');
		$new_object->setSouhaitPublic('');
		$new_object->setSouhaitSexe('');
		$new_object->setTypeAccueil('');
		
		$em->persist($new_object);
		$em->flush();

		$new_version = new Version();
		$new_version->setNode($node);
		$new_version->setObject($new_object);
		$new_version->setLang($lang);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		$em->persist($new_version);
		
		// Node liste familles
		
		$node_liste_familles=new Node();
		$node_liste_familles->setNodeName('');
		$node_liste_familles->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name("Liste des familles d'accueil"));
		$em->persist($node_liste_familles);
		
		// version liste familles
		
		$version_liste_familles=new Version();
		$version_liste_familles->setNode($node_liste_familles);
		$version_liste_familles->setObject($new_object);
		$version_liste_familles->setLang($lang);
		$version_liste_familles->setRevision(1);
		$version_liste_familles->setRevisionBy($user);
		$em->persist($version_liste_familles);

		$em->flush();

		return $this->redirect($this->generateUrl("sidus_edit_node",array(
					'node_id' => $node->getId(),
					'lang' => $lang,
		)), 301 );
	}
	
	public function statutDisponibleAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutFamille')->find(1);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
	
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name("Liste des familles d'accueil")->getId(), $lang);
		return $this->render('SICLAAraBundle:FolderFamilleAccueil:show.html.twig', $this->loaded_objects);

	}
	
	public function statutIndisponibleAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutFamille')->find(2);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
	
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name("Liste des familles d'accueil")->getId(), $lang);
		return $this->render('SICLAAraBundle:FolderFamilleAccueil:show.html.twig', $this->loaded_objects);

	}
	
	public function statutAttenteAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutFamille')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
	
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name("Liste des familles d'accueil")->getId(), $lang);
		return $this->render('SICLAAraBundle:FolderFamilleAccueil:show.html.twig', $this->loaded_objects);

	}
	
	public function statutPropositionAccepteeAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutFamille')->find(4);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
	
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name("Liste des familles d'accueil")->getId(), $lang);
		return $this->render('SICLAAraBundle:FolderFamilleAccueil:show.html.twig', $this->loaded_objects);

	}
	
	public function statutAffecteAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutFamille')->find(5);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
	
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name("Liste des familles d'accueil")->getId(), $lang);
		return $this->render('SICLAAraBundle:FolderFamilleAccueil:show.html.twig', $this->loaded_objects);

	}
}

?>
	