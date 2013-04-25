<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Entity\Logement;
use SICLA\AraBundle\Form\LogementType;


class LogementController extends CommonController
{
	public function showAction($loaded_objects) {
		return $this->render('SICLAAraBundle:Logement:show.html.twig', $loaded_objects);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		$form = $this->createForm(new LogementType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
			//if ($form->isValid()) {
				//@TODO version
				$em->persist($object);
				$em->flush();
				$this->setFlash('success', 'Your modifications have been saved');
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
			//	}
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:Logement:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $lang, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);
		$typeLogement=$em->getRepository('SICLAAraBundle:TypeLogement')->find(1);
		$new_object = new Logement();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setMeuble('');
		$new_object->setNbChambres('');
		$new_object->setLoyer('');
		$new_object->setSurface('');
		$new_object->setConsommationEnergie('');
		$new_object->setEmissionGes('');
		$new_object->setCharges('');
		$new_object->setAscenseur('');
		$new_object->setSdbPrivative('');
		$new_object->setTypeLogement($typeLogement); // à modifier
		
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
	
	/* public function form_logementAction(Request $request)
    {
		$form=$this->createForm(new LogementType());
		
		$em = $this->getDoctrine()->getEntityManager();
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
			$logement= $form->getData();
			$em->persist($logement);
			$em->flush();
			
			
		}
		
        return $this->render('SICLAAraBundle:Form:form_logement.html.twig', array('form'=>$form->createView()));
	}
	 public function view_form_logementAction($id,Request $request)
    {
		$logement=$this->getDoctrine()->getRepository('SICLAAraBundle:Logement')->find($id);
		$form = $this->createForm(new LogementType(),$logement);
		
		$em = $this->getDoctrine()->getEntityManager();
		
		if ($request->isMethod('POST')) {
			$form->bind($request);
			$logement = $form->getData();
			$em->flush();
			
		}
		
		return $this->render('SICLAAraBundle:Form:view_logement.html.twig', array('logement' => $logement, 'form' => $form->createView()));
	}*/
	
}

?>
	