<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
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
			if ($form->isValid()) {
				//@TODO version
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), '_locale' => $version->getLang())));
			}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:ApprenantDemandeLogement:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $_locale, $type) {

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
		$new_version->setLang($_locale);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		$em->persist($new_version);

		$em->flush();

		return $this->redirect($this->generateUrl('sidus_edit_node',array(
					'node_id' => $node->getId(),
					'_locale' => $_locale,
		)), 301 );
	}
	/*
 public function form_apprenantAction(Request $request)
    {
		$form=$this->createForm(new ApprenantDemandeLogementType());
        
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$form->bind($this->getRequest());
		
		if ($request->isMethod('POST')) {

			$apprenantDemandeLogement = $form->getData();
			$em->persist($apprenantDemandeLogement);
			$em->flush();
			

		}
	
		return $this->render('SICLAAraBundle:Form:form_apprenant.html.twig', array('form'=>$form->createView()));

	}
	 public function view_form_apprenantAction($id,Request $request)
    {
		$apprenant=$this->getDoctrine()->getRepository('SICLAAraBundle:ApprenantDemandeLogement')->find($id);
		$form = $this->createForm(new ApprenantDemandeLogementType(),$apprenant);;
		
		$em = $this->getDoctrine()->getEntityManager();
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
			$apprenant = $form->getData();
			$em->flush();
		}
		
		
		
		return $this->render('SICLAAraBundle:Form:view_apprenant.html.twig', array('apprenant' => $apprenant, 'form' => $form->createView()));
	}
	
	 public function view_liste_apprenantsAction()
    {
		$apprenants=$this->getDoctrine()->getRepository('SICLAAraBundle:ApprenantDemandeLogement')->findall();
		
		return $this->render('SICLAAraBundle:Liste:liste_apprenants.html.twig', array('apprenants' => $apprenants));
	}*/
}

?>
