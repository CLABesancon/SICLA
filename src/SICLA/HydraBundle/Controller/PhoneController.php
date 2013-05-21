<?php

namespace SICLA\HydraBundle\Controller;
use SICLA\HydraBundle\Form\PhoneType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PhoneController extends Controller{

	public function form_phoneAction(Request $request)
    {
		$form=$this->createForm(new PhoneType());
		$em = $this->getDoctrine()->getEntityManager();
		$form->bind($this->getRequest());
		if ($request->isMethod('POST')) {

			$phone = $form->getData();
			echo'<pre>';
			var_dump($phone);
			echo'</pre>';
			exit;
			$em->persist($phone);
			$em->flush();
		}
		return $this->render('SICLAHydraBundle:Form:form_phone.html.twig', array('form'=>$form->createView()));
	}
}
