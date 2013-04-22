<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Form\ProprietaireType;
use SICLA\AraBundle\Entity\Proprietaire;


class ProprietaireController extends CommonController
{
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:Proprietaire:show.html.twig', $loaded_objects);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new ProprietaireType(), $object);
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
		return $this->render('SICLAAraBundle:Proprietaire:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $_locale, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);

		$new_object = new Proprietaire();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setTelephone2('');
		$new_object->setCourriel2('');
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
	
	
 /*public function form_proprietaireAction(Request $request)
    {
		$form=$this->createForm(new ProprietaireType());
		
		$em = $this->getDoctrine()->getEntityManager();
		
		$form->bind($this->getRequest());
		
		if ($request->isMethod('POST')) {

			$proprietaire = $form->getData();
			$em->persist($proprietaire);
			$em->flush();
			

		}
		
        return $this->render('SICLAAraBundle:Form:form_proprietaire.html.twig', array('form'=>$form->createView()));
	
	}*/
}

?>
	