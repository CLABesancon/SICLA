<?php
namespace SICLA\AraBundle\Controller;

use SICLA\HydraBundle\Controller\PersonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\HydraBundle\Entity\Person;
use Sidus\SidusBundle\Entity\Node;
use Sidus\SidusBundle\Entity\Object;

class ProprietaireController extends PersonController {
	
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:Proprietaire:show.html.twig', $loaded_objects);
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
		
		//Node liste propriétaires
		
		$node_liste_proprietaire=new Node();
		$node_liste_proprietaire->setNodeName('');
		$node_liste_proprietaire->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des propriétaires'));
		$em->persist($node_liste_proprietaire);
		
		// version liste propriétaires
		
		$version_liste_proprietaire=new Version();
		$version_liste_proprietaire->setNode($node_liste_proprietaire);
		$version_liste_proprietaire->setObject($new_object);
		$version_liste_proprietaire->setLang($lang);
		$version_liste_proprietaire->setRevision(1);
		$version_liste_proprietaire->setRevisionBy($user);
		$em->persist($version_liste_proprietaire);
		
		$em->flush();

		return $this->redirect($this->generateUrl('sidus_edit_node',array(
					'node_id' => $node->getId(),
					'lang' => $lang,
		)), 301 );
	}
}

?>