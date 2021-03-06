<?php
namespace SICLA\AraBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sidus\SidusBundle\Controller\CommonController;
use Sidus\SidusBundle\Entity\Version;
use SICLA\AraBundle\Entity\Logement;
use Sidus\SidusBundle\Entity\Node;
use SICLA\AraBundle\Form\LogementType;
use Symfony\Component\HttpFoundation\Response;


class LogementController extends CommonController
{
	public function showAction($loaded_objects) {
		$html = $this->renderView('SICLAAraBundle:Logement:show.html.twig', $loaded_objects
		);

		return new Response(
			$this->get('knp_snappy.pdf')->getOutputFromHtml($html),
			200,
			array(
				'Content-Type'          => 'application/pdf',
				'Content-Disposition'   => 'attachment; filename="file.pdf"'
			)
		);
	}

	public function editAction($version, $object, $loaded_objects, Request $request) {
		
		$form = $this->createForm(new LogementType(), $object);
		$em = $this->getDoctrine()->getEntityManager();

		if ($request->isMethod('POST')) {
			$form->bind($request);
				//@TODO version
				$contenu_annonce=trim($object->getAnnonce());
				
				if($contenu_annonce=='')
				{
					$object->setStatut($em->getRepository('SICLAAraBundle:StatutAnnonce')->findOneByLibelle("Pas d'annonce"));
				}
				else
				{
					$object->setStatut($em->getRepository('SICLAAraBundle:StatutAnnonce')->findOneByLibelle('Non validée'));
				}
				$object->setTitle($object->getTypeLogement()->getLibelle()." de ".$object->getSurface()." m² à ".$object->getLoyer()."€");
				$em->persist($object);
				$em->flush();
				return $this->redirect($this->generateUrl('sidus_show_node', array('node_id' => $version->getNode()->getId(), 'lang' => $version->getLang())));
		}
		$loaded_objects['form'] = $form->createView();
		return $this->render('SICLAAraBundle:Logement:edit.html.twig', $loaded_objects);
	}

	public function addAction($node, $lang, $type) {

		$em = $this->getDoctrine()->getEntityManager();
		//@TODO : get connected user
		$user = $em->getRepository('SidusBundle:Node')->find(2);
		$new_object = new Logement();
		$new_object->setType($type);
		$new_object->setTitle('');
		$new_object->setMeuble('');
		$new_object->setNbChambres('');
		$new_object->setLoyer('');
		$new_object->setEcheanceLoyer('');
		$new_object->setSurface('');
		$new_object->setConsommationEnergie('');
		$new_object->setEmissionGes('');
		$new_object->setCharges('');
		$new_object->setAscenseur('');
		$new_object->setSdbPrivative('');
		$new_object->setAnnonce('');
		$new_object->setParentIdProprietaire($node->getParent()->getId());
		
		$em->persist($new_object);
		$em->flush();

		$new_version = new Version();
		$new_version->setNode($node);
		$new_version->setObject($new_object);
		$new_version->setLang($lang);
		$new_version->setRevision(1);
		$new_version->setRevisionBy($user);
		
		$em->persist($new_version);
		
		// Node liste logement
		
		$node_logement=new Node();
		$node_logement->setNodeName('');
		$node_logement->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des logements'));
		$em->persist($node_logement);
		
		// version liste logement
		
		$version_logement=new Version();
		$version_logement->setNode($node_logement);
		$version_logement->setObject($new_object);
		$version_logement->setLang($lang);
		$version_logement->setRevision(1);
		$version_logement->setRevisionBy($user);
		$em->persist($version_logement);
		
		 //Node liste annonces
		
		$node_annonce=new Node();
		$node_annonce->setNodeName('');
		$node_annonce->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des annonces'));
		$em->persist($node_annonce);
		
		// version liste annonces
		
		$version_annonce=new Version();
		$version_annonce->setNode($node_annonce);
		$version_annonce->setObject($new_object);
		$version_annonce->setLang($lang);
		$version_annonce->setRevision(1);
		$version_annonce->setRevisionBy($user);
		$em->persist($version_annonce);
		
		// Node liste petites annonces
		
		$node_petites_annonce=new Node();
		$node_petites_annonce->setNodeName('');
		$node_petites_annonce->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->findOneByNode_name('Liste des petites annonces'));
		$em->persist($node_petites_annonce);
		
		// version liste petites annonces
		
		$version_petites_annonce=new Version();
		$version_petites_annonce->setNode($node_petites_annonce);
		$version_petites_annonce->setObject($new_object);
		$version_petites_annonce->setLang($lang);
		$version_petites_annonce->setRevision(1);
		$version_petites_annonce->setRevisionBy($user);
		$em->persist($version_petites_annonce);
		
		$em->flush();

		return $this->redirect($this->generateUrl('sidus_edit_node',array(
					'node_id' => $node->getId(),
					'lang' => $lang,
		)), 301 );
	}
		
	
}

?>
	