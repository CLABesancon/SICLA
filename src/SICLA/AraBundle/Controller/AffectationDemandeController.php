<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Entity\AffectationDemande;
use SICLA\AraBundle\Form\AffectationDemandeType;
use SICLA\AraBundle\Form\AffectationDemandeAddFamilleType;
use Doctrine\Common\Collections\ArrayCollection;

class AffectationDemandeController extends CommonController
{
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:AffectationDemandes:show.html.twig', $loaded_objects);
	}
	
	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new AffectationDemandeType(), $object);
		$em = $this->getDoctrine()->getEntityManager();
		$demandes = $em->getRepository('SICLAAraBundle:ApprenantDemandeLogement')->findAll();
		if ($request->isMethod('POST')) {
			 $form->bind($request);
				$em->flush();
								$this->setFlash('success', 'Sélection de la famille');
								return $this->redirect($this->generateUrl('sicla_ara_addFamille', 
											array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
 
		}
		
		// On n'affiche que les demandes qui ne font l'objet d'aucune affectation
		$demandes_a_afficher=new ArrayCollection();
		
		foreach($demandes as $demande){
			if($demande->getAffectations()->count()==0)
			{
				$demandes_a_afficher->add($demande);
			}
		}

		$loaded_objects['node_id']=$version->getNode()->getId();
		$loaded_objects['demandes']=$demandes_a_afficher;
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:AffectationDemandes:edit.html.twig', $loaded_objects);
	}
	/*
	public function addFamilleAction(Request $request, $node_id, $lang = null) {
		
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$form = $this->createForm(new AffectationDemandeAddFamilleType(), $this->loaded_objects['object']);
		$em = $this->getDoctrine()->getEntityManager();
		$familles = $em->getRepository('SICLAAraBundle:FamilleAccueil')->findFamillesDispos($this->loaded_objects['object']->getDateArrivee(),$this->loaded_objects['object']->getDateDepart());
		if ($request->isMethod('POST')) {
			 $form->bind($request);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', 
						array('node_id' => $this->loaded_objects['node']->getId(), 
							  'lang' => $this->loaded_objects['version']->getLang())));
		}

		$loaded_objects= $this->loaded_objects;
		$loaded_objects['familles']=$familles;
		$loaded_objects['form'] = $form->createView();
		$loaded_objects['demande']=$this->loaded_objects['object']->getDemande();
		return $this->render('SICLAAraBundle:AffectationDemandes:addFamille.html.twig',$loaded_objects);
	}*/
	
	public function addFamilleAction(Request $request, $node_id, $lang = null) {
		
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$form = $this->createForm(new AffectationDemandeAddFamilleType(), $this->loaded_objects['object']);
		$em = $this->getDoctrine()->getEntityManager();
		$familles = $em->getRepository('SICLAAraBundle:FamilleAccueil')->findFamillesDispos($this->loaded_objects['object']->getDateArrivee(),$this->loaded_objects['object']->getDateDepart());
		if ($request->isMethod('POST')) {
			 $form->bind($request);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', 
						array('node_id' => $this->loaded_objects['node']->getId(), 
							  'lang' => $this->loaded_objects['version']->getLang())));
		}
		
		$familles_a_afficher=new ArrayCollection();
		
		// on vérifie que la famille n'a pas plus d'affectations que de lits disponibles 
		foreach($familles as $famille){
			if($em->getRepository('SICLAAraBundle:FamilleAccueil')->getNbAffectations($famille->getId(),$this->loaded_objects['object']->getDateArrivee(), $this->loaded_objects['object']->getDateDepart() ) <= $famille->getNbLit()){
				$familles_a_afficher->add($famille);
			}
		}

		$loaded_objects= $this->loaded_objects;
		$loaded_objects['familles']=$familles_a_afficher;
		$loaded_objects['form'] = $form->createView();
		$loaded_objects['demande']=$this->loaded_objects['object']->getDemande();
		return $this->render('SICLAAraBundle:AffectationDemandes:addFamille.html.twig',$loaded_objects);
	}
	
	public function addAction($node, $lang, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);
		$new_object = new AffectationDemande();
		$new_object->setType($type);
		$new_object->setTitle(' ');
		
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
	