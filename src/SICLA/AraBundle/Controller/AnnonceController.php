<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Form\AnnonceType;
use SICLA\AraBundle\Entity\Annonce;


class AnnonceController extends CommonController
{
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:Annonce:show.html.twig', $loaded_objects);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new AnnonceType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			//if ($form->isValid()) {
				//@TODO version
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
			//}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:Annonce:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $lang, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		$node_parent = $node->getParent();
		$version_parent = $em->getRepository('SidusBundle:Version')->findLastVersion($node_parent, $lang);
		$object_parent=$version_parent->getObject();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(2);
		$new_object = new Annonce();
		$new_object->setType($type);
		$new_object->setTitle('Annonce concernant le logement de type '.$object_parent->getTitle());
		$new_object->setAnnonce('');
		$new_object->setStatut($statut);
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
	
	public function validateAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(1);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
		
		return $this->render('SICLAAraBundle:Annonce:show.html.twig', $this->loaded_objects);

	}
	
	public function archivateAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
		
		return $this->render('SICLAAraBundle:Annonce:show.html.twig', $this->loaded_objects);

	}
	
	public function contactAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->	getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(4);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
		
		return $this->render('SICLAAraBundle:Annonce:show.html.twig', $this->loaded_objects);

	}
	
}

?>
	