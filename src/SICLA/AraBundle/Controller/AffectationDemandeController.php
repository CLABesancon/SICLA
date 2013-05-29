<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Entity\AffectationDemande;
use SICLA\AraBundle\Form\AffectationDemandeType;
use SICLA\AraBundle\Form\AffectationDemandeFamilleType;
use Doctrine\Common\Collections\ArrayCollection;

class AffectationDemandeController extends CommonController
{
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:AffectationDemandes:show.html.twig', $loaded_objects);
	}
	/*
	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new AffectationDemandeType(), $object);
		$em = $this->getDoctrine()->getEntityManager();
		$demandes = $em->getRepository('SICLAAraBundle:ApprenantDemandeLogement')->findAll();
		if ($request->isMethod('POST')) {
			 $form->bind($request);
			if ($form->isValid()) {
				$em->flush();
				$form_familles=$this->createForm(new AffectationDemandeFamilleType(), $object);
				$familles=$em->getRepository('SICLAAraBundle:FamilleAccueil')->findFamillesDispos($object->getDateArrivee(),$object->getDateDepart());
				$loaded_objects['form_familles']=$form_familles->createView();
				$loaded_objects['familles']=$familles;
				if ($request->isMethod('POST')) {
					$form_familles->bind($request);
						if ($form_familles->isValid()) {
								$this->setFlash('success', 'Your modifications have been saved');
								return $this->redirect($this->generateUrl('sidus_show_node', 
											array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
								//} 
						}
				}
			}
			
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
	}*/
	
	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new AffectationDemandeType(), $object);
		$em = $this->getDoctrine()->getEntityManager();
		$demandes = $em->getRepository('SICLAAraBundle:ApprenantDemandeLogement')->findAll();
		if ($request->isMethod('POST')) {
			 $form->bind($request);
			if ($form->isValid()) {
				$em->flush();
								$this->setFlash('success', 'Your modifications have been saved');
								return $this->redirect($this->generateUrl('sicla_ara_addFamille', 
											array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
 
						}
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
	
	public function addFamilleAction(Request $request, $node_id, $lang = null) {
		
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$form = $this->createForm(new AffectationDemandeFamilleType(), $this->loaded_objects['object']);
		$em = $this->getDoctrine()->getEntityManager();
		$demandes = $em->getRepository('SICLAAraBundle:ApprenantDemandeLogement')->findAll();
		if ($request->isMethod('POST')) {
			 $form->bind($request);
			if ($form->isValid()) {
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', 
						array('node_id' => $this->loaded_objects['node']->getId(), 
							  'lang' => $this->loaded_objects['version']->getLang())));
						}
				}

		$loaded_objects= $this->loaded_objects;
		$loaded_objects['demandes']=$demandes;
		$loaded_objects['form'] = $form->createView();
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
	