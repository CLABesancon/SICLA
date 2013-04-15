<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Form\TypeType;
use Sidus\SidusBundle\Entity\Type;
use Sidus\SidusBundle\Entity\Version;


class TypeController extends Controller {
	
	public function showAction($node,$ascendants,$descendants,$object){
            $em = $this->getDoctrine()->getManager();
            return $this->render('SidusBundle:Type:show.html.twig',array(
                'node'=>$node,
				'ascendants'=>$ascendants,
				'descendants' => $descendants,
                'object'=>$object,
                ));
	}
	
	public function editAction($node,$ascendants,$descendants,$object,Request $request){
			$form=$this->createForm(new TypeType(), $object);
			$em=$this->getDoctrine()->getEntityManager();
			
			if($request->isMethod('POST')){
				$form->bind($request);
				if ($form->isValid()){
					//@TODO version
					$em->persist($object);
					$em->flush();
					return $this->forward('SidusBundle:Type:show', array(
						'node'=>$node,
						'ascendants'=>$ascendants,
						'descendants' => $descendants,
						'object'=>$object,
					));
				}
			}
			          
            return $this->render('SidusBundle:Type:edit.html.twig',array(
                'form'=>$form->createView(),
				'node'=>$node,
				'ascendants'=>$ascendants,
                'object'=>$object,
                ));
	}
	
	public function addAction($node, $_locale, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);

		$new_object = new Type();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setTypename('');
		$new_object->setController('');
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
}