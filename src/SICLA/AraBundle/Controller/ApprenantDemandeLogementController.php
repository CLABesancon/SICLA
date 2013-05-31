<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use Sidus\SidusBundle\Entity\Node;
use SICLA\AraBundle\Form\ApprenantDemandeLogementType;
use SICLA\AraBundle\Entity\ApprenantDemandeLogement;


class ApprenantDemandeLogementController extends CommonController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:ApprenantDemandeLogement:show.html.twig', $loaded_objects);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new ApprenantDemandeLogementType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
				//@TODO version
				
				$object->setTitle($object->getNom().' '.$object->getPrenom());
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:ApprenantDemandeLogement:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $lang, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);

		$new_object = new ApprenantDemandeLogement();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setHandicapPhysique('');
		$new_object->setDetailHandicap('');
		$new_object->setTraitementMedical('');
		$new_object->setDetailTraitement('');
		$new_object->setAllergiesAnimaux('');
		$new_object->setDetailAllergiesAnimaux('');
		$new_object->setAllergiesAlimentaires('');
		$new_object->setDetailAllergiesAlimentaires('');
		$new_object->setAllergiesAutres('');
		$new_object->setDetailAllergiesAutres('');
		$new_object->setFumeur('');
		$new_object->setTolerantFumee('');
		$new_object->setVehicule('');
		$new_object->setVoeuxPersonnels('');
		$new_object->setDetailVoeuxPersonnels('');
		$new_object->setLoisirsParticuliers('');
		$new_object->setDetailLoisirsParticuliers('');
		
		$em->persist($new_object);
		$em->flush();

		$new_version = new Version();
		$new_version->setNode($node);
		$new_version->setObject($new_object);
		$new_version->setLang($lang);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		$em->persist($new_version);
		 /*
		//Node Liste des demandes de logement des apprenants
		
		$node_liste_demandes=new Node();
		$node_liste_demandes->setNodeName('');
		$node_liste_demandes->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des demandes d\hébergement des apprenants'));
		$em->persist($node_liste_demandes);
		
		// version Liste des demandes de logement des apprenants
		
		$version_liste_demandes=new Version();
		$version_liste_demandes->setNode($node_liste_demandes);
		$version_liste_demandes->setObject($new_object);
		$version_liste_demandes->setLang($lang);
		$version_liste_demandes->setRevision(1);
		$version_liste_demandes->setRevisionBy($user);
		$em->persist($version_liste_demandes);
		*/
		$em->flush();

		return $this->redirect($this->generateUrl('sidus_edit_node',array(
					'node_id' => $node->getId(),
					'lang' => $lang,
		)), 301 );
	}

}

?>
