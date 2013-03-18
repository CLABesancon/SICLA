<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Form\FolderType;


class FolderController extends Controller {
	
	public function viewAction($node,$ascendants,$descendants,$object){
            $em = $this->getDoctrine()->getManager();
            return $this->render('SidusBundle:Folder:view.html.twig',array(
                'node'=>$node,
				'ascendants'=>$ascendants,
				'descendants' => $descendants,
                'object'=>$object,
                ));
	}
	
	public function editAction($node,$ascendants,$descendants,$object,Request $request){
			$form=$this->createForm(new FolderType(), $object);
			$em=$this->getDoctrine()->getEntityManager();
			
			if($request->isMethod('POST')){
				$form->bind($request);
				if ($form->isValid()){
					//@TODO version
					$em->persist($object);
					$em->flush();
					return $this->forward('SidusBundle:Folder:view', array(
						'node'=>$node,
						'ascendants'=>$ascendants,
						'descendants' => $descendants,
						'object'=>$object,
					));
				}
			}
			          
            return $this->render('SidusBundle:Folder:edit.html.twig',array(
                'form'=>$form->createView(),
				'node'=>$node,
				'ascendants'=>$ascendants,
                'object'=>$object,
                ));
	}
	
	public function addAction($node,$ascendants,$descendants,$object,Request $request){
		
	}
}