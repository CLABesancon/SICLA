<?php

namespace SICLA\HydraBundle\Controller;
use SICLA\HydraBundle\Form\AddressType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AddressController extends Controller{

	public function form_addressAction(Request $request)
    {
		$form=$this->createForm(new AddressType());
		$em = $this->getDoctrine()->getEntityManager();
		$form->bind($this->getRequest());
		if ($request->isMethod('POST')) {

			$address = $form->getData();
			$em->persist($address);
			$em->flush();
		}
		return $this->render('SICLAHydraBundle:Form:form_address.html.twig', array('form'=>$form->createView()));
	}
}

?>
