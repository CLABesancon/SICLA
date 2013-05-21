<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\CommonController;


class AnnonceController extends CommonController
{
	
	public function validateAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(1);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
		
		$message = \Swift_Message::newInstance()
        ->setSubject('Validation de votre annonce '.$this->loaded_objects['object']->getTitle())
        ->setFrom('send@example.com')
        ->setTo('laurent.predine@gmail.com')
        ->setBody('Bonjour <br/> Votre annonce a bien été validée.');
		$this->get('mailer')->send($message);
		
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces')->getId(), $lang);
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $this->loaded_objects);

	}
	
	public function archivateAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		
		$message = \Swift_Message::newInstance()
        ->setSubject('Archivage de votre annonce '.$this->loaded_objects['object']->getTitle())
        ->setFrom('send@example.com')
        ->setTo('laurent.predine@gmail.com')
        ->setBody('Bonjour <br/> Votre annonce a bien été validée.');
		$this->get('mailer')->send($message);
		
		$em->flush();
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces')->getId(), $lang);
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $this->loaded_objects);

	}
	
	// Archivage d'une annonce depuis un logement
	
	public function archivateLogementAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		
		$message = \Swift_Message::newInstance()
        ->setSubject('Archivage de votre annonce '.$this->loaded_objects['object']->getTitle())
        ->setFrom('send@example.com')
        ->setTo('laurent.predine@gmail.com')
        ->setBody('Bonjour <br/> Votre annonce a bien été validée.');
		
		$this->get('mailer')->send($message);
		$em->flush();
		return $this->render('SICLAAraBundle:Logement:show.html.twig', $this->loaded_objects);

	}
	
	
	public function deleteAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(4);
		$this->loaded_objects['object']->setStatut($statut);
		$this->loaded_objects['object']->setAnnonce('');
		
		$message = \Swift_Message::newInstance()
        ->setSubject('Suppression de votre annonce'.$this->loaded_objects['object']->getTitle())
        ->setFrom('send@example.com')
        ->setTo('laurent.predine@gmail.com')
        ->setBody('Bonjour <br/> Votre annonce a bien été validée.');
		$this->get('mailer')->send($message);
		
		$em->flush();
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces')->getId(), $lang);
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $this->loaded_objects);

	}
	
	public function contactAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		$em->flush();
		
		// Récupération de l'adresse mail //
		
		// On récupère le logement associé à l'annonce
		$title="Annonce concernant le ".$this->loaded_objects['object']->getTitle();
		$idProprietaire=$this->loaded_objects['object']->getParentIdProprietaire();
		$this->loadObjectsForNodeUID($idProprietaire, $lang);
		
		// On récupère le parent de ce logement càd le propriétaire,  puis l'user correspondant à ce propriétaire
		$node_user=$this->loaded_objects['node']->getParent()->getId();
		$this->loadObjectsForNodeUID($node_user, $lang);
		$mail=$this->loaded_objects['object']->getEmail();
		$this->loadObjectsForNodeUID($node_id, $lang);
		$this->loaded_objects['mail']=$mail;
		$this->loaded_objects['mail_title']=$title; 
		
		return $this->render('SICLAAraBundle:Form:contact.html.twig', $this->loaded_objects);

	}
	
	
	
}

?>
	