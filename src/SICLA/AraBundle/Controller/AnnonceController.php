<?php
namespace SICLA\AraBundle\Controller;

use Sidus\SidusBundle\Controller\CommonController;
use Symfony\Component\HttpFoundation\Request;
use  SICLA\AraBundle\Form\ContactFormType;

class AnnonceController extends CommonController
{
	// validation d'une annonce [Service Logement]
	public function validateAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(1);
		$this->loaded_objects['object']->setStatut($statut);
		
		$em->flush();
		
		$message = \Swift_Message::newInstance()
        ->setSubject('Validation de votre annonce '.$this->loaded_objects['object']->getTitle())
        ->setFrom('send@example.com')
        ->setTo('noname@gmail.com')
        ->setBody('Bonjour <br/> Votre annonce a bien été validée.', 'text/html');
		$this->get('mailer')->send($message);
		
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces')->getId(), $lang);
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $this->loaded_objects);

	}
	// archivage d'une annonce [Service Logement]
	public function archivateAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		
		$message = \Swift_Message::newInstance()
        ->setSubject('Archivage de votre annonce '.$this->loaded_objects['object']->getTitle())
        ->setFrom('logement-cla@univ-fcomte.fr')
        ->setTo('noname@gmail.com')
        ->setBody('Bonjour <br/> Votre annonce a bien été archivée.', 'text/html');
		$this->get('mailer')->send($message);
		
		$em->flush();
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces')->getId(), $lang);
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $this->loaded_objects);

	}
	
	// Archivage d'une annonce depuis la vue d'un logement [Propriétaire] [Service Logement]
	
	public function archivateLogementAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(3);
		$this->loaded_objects['object']->setStatut($statut);
		
		$message = \Swift_Message::newInstance()
        ->setSubject('Archivage de votre annonce '.$this->loaded_objects['object']->getTitle())
        ->setFrom('logement-cla@univ-fcomte.fr')
        ->setTo('noname@gmail.com')
        ->setBody('Bonjour <br/> Votre annonce a bien été archivée.', 'text/html');
		
		$this->get('mailer')->send($message);
		$em->flush();
		return $this->render('SICLAAraBundle:Logement:show.html.twig', $this->loaded_objects);

	}
	
	// Suppression d'une annonce [Propriétaire] [Service Logement]
	public function deleteAction($node_id, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(4);
		$this->loaded_objects['object']->setStatut($statut);
		$this->loaded_objects['object']->setAnnonce('');
		
		$message = \Swift_Message::newInstance()
        ->setSubject('Suppression de votre annonce'.$this->loaded_objects['object']->getTitle())
        ->setFrom('logement-cla@univ-fcomte.fr')
        ->setTo('noname@gmail.com')
        ->setBody('Bonjour <br/> Votre annonce a bien été supprimée.', 'text/html');
		$this->get('mailer')->send($message);
		
		$em->flush();
		$this->loadObjectsForNodeUID($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces')->getId(), $lang);
		return $this->render('SICLAAraBundle:Annonces:show.html.twig', $this->loaded_objects);

	}
	
	public function reviserAction($node_id, Request $request, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		$em = $this->getDoctrine()->getEntityManager();
		$statut= $em->getRepository('SICLAAraBundle:StatutAnnonce')->find(5);
		$this->loaded_objects['object']->setStatut($statut);
		$em->flush();
		
		// Récupération de l'adresse mail //
		
		// On récupère le propriétaire associé au logement 
		$title="Annonce concernant le ".$this->loaded_objects['object']->getTitle();
		$idProprietaire=$this->loaded_objects['object']->getParentIdProprietaire();
		$this->loadObjectsForNodeUID($idProprietaire, $lang);
		
		// On récupère le mail de ce propriétaire 
		//$mail=$this->loaded_objects['object']->getMail();

		$mail="test@test.fr"; // en attendant qu'une personne soit liée à un user
		$this->loadObjectsForNodeUID($node_id, $lang);
		$this->loaded_objects['mail']=$mail;
		$this->loaded_objects['mail_title']=$title; 
		$form = $this->createForm(new ContactFormType());
		$this->loaded_objects['form'] = $form->createView();
			if ($request->isMethod('POST')) {
				$form->bind($request);
					$message = \Swift_Message::newInstance()
						->setSubject($form->get('sujet')->getData())
						->setFrom($form->get('email')->getData())
						->setTo($mail)
						->setBody($form->get('message')->getData());

					$this->get('mailer')->send($message);

					$request->getSession()->getFlashBag()->add('success', 'Votre message a bien été envoyé.');

					return $this->render('SICLAAraBundle:Form:contact.html.twig', $this->loaded_objects);
				
			}
		
		
		return $this->render('SICLAAraBundle:Form:contact.html.twig', $this->loaded_objects);

	}
	
	public function contactAction($node_id, Request $request, $lang = null) {
		$this->loadObjectsForNodeUID($node_id, $lang);
		
		// Récupération de l'adresse mail //
		
		// On récupère le propriétaire associé au logement 
		$title="Annonce concernant le ".$this->loaded_objects['object']->getTitle();
		$idProprietaire=$this->loaded_objects['object']->getParentIdProprietaire();
		$this->loadObjectsForNodeUID($idProprietaire, $lang);
		
		// On récupère le mail de ce propriétaire 
		//$mail=$this->loaded_objects['object']->getMail();


		$mail="test@test.fr"; // en attendant qu'une personne soit liée à un user
		$this->loadObjectsForNodeUID($node_id, $lang);
		$this->loaded_objects['mail']=$mail;
		$this->loaded_objects['mail_title']=$title; 
		$form = $this->createForm(new ContactFormType());
		$this->loaded_objects['form'] = $form->createView();
			if ($request->isMethod('POST')) {
				$form->bind($request);
					$message = \Swift_Message::newInstance()
						->setSubject($form->get('sujet')->getData())
						->setFrom($form->get('email')->getData())
						->setTo($mail)
						->setBody($form->get('message')->getData());

					$this->get('mailer')->send($message);

					$request->getSession()->getFlashBag()->add('success', 'Votre message a bien été envoyé.');

					return $this->render('SICLAAraBundle:Form:contact.html.twig', $this->loaded_objects);
				
			}
		
		
		return $this->render('SICLAAraBundle:Form:contact.html.twig', $this->loaded_objects);

	}
	
	
	
}

?>
	
