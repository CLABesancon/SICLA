<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Form\AnnonceType;
use SICLA\AraBundle\Entity\Annonce;
use Sidus\SidusBundle\Entity\Node;


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
		$new_object->setTitle($object_parent->getTitle());
		$new_object->setAnnonce('');
		$new_object->setStatut($statut);
		$new_object->setParentIdLogement($node->getParent()->getId());
		$em->persist($new_object);
		$em->flush();

		$new_version = new Version();
		$new_version->setNode($node);
		$new_version->setObject($new_object);
		$new_version->setLang($lang);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		$em->persist($new_version);
		
		// Node liste annonces
		
		$node_annonce=new Node();
		$node_annonce->setNodeName('');
		$node_annonce->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces'));
		$em->persist($node_annonce);
		
		// version liste annonces
		
		$version_annonce=new Version();
		$version_annonce->setNode($node_annonce);
		$version_annonce->setObject($new_object);
		$version_annonce->setLang($lang);
		$version_annonce->setRevision(1);
		$version_annonce->setRevisionBy($user);
		$em->persist($version_annonce);
		
		// Node liste des petites annonces
		
		$node_petites_annonces=new Node();
		$node_petites_annonces->setNodeName('');
		$node_petites_annonces->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces'));
		$em->persist($node_petites_annonces);
		
		// version liste petites annonces
		
		$version_petites_annonces=new Version();
		$version_petites_annonces->setNode($node_petites_annonces);
		$version_petites_annonces->setObject($new_object);
		$version_petites_annonces->setLang($lang);
		$version_petites_annonces->setRevision(1);
		$version_petites_annonces->setRevisionBy($user);
		$em->persist($version_petites_annonces);
		
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
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces')->getId(), $lang);
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $this->loaded_objects);

	}
	
	public function archivateAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces')->getId(), $lang);
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $this->loaded_objects);

	}
	
	public function contactAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		// Récupération de l'adresse mail //
		
		// On récupère le logement associé à l'annonce
		$this->loadObjectsForNodeUID(42, $lang);
		// On récupère le parent de ce logement càd le propriétaire, ensuite la personne, puis l'user correspondant à ce propriétaire
		//$node_user=$this->loaded_objects['node']->getParent()->getParent();
		$node_user=$this->loaded_objects['node']->getParent()->getParent()->getId();
		$this->loadObjectsForNodeUID($node_user, $lang);
		$mail=$this->loaded_objects['version']->getObject()->getEmail();
		
		$em->flush();
		return $this->render('SICLAAraBundle:Annonce:show.html.twig', $mail);

	}
	
}

?>
	