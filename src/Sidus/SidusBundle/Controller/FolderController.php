<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class FolderController extends Controller {
	
	public function viewAction($node,$ascendants,$object,$version){
            $em = $this->getDoctrine()->getManager();
            return $this->render('SidusBundle:Folder:view.html.twig',array(
                'node'=>$node,
				'ascendants'=>$ascendants,
                'object'=>$object,
                ));
	}
}