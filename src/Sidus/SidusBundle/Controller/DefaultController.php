<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Sidus\SidusBundle\Entity\Node;

class DefaultController extends Controller {
	
	public function loginAction(){
		if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')){
			return $this->redirect($this->generateUrl('sidus_view_node', array('id_node'=>1)));
		}
		$request = $this->getRequest();
		$session = $request->getSession();
		if($request->attributes->has(SecurityContext::AUTHENTICATION_ERROR)){
			$error = $request->attributes->get(SecurityContext::AUTHENTICATION_ERROR);
		}else{
			$error = $session->get(SecurityContext::AUTHENTICATION_ERROR);
			$session->remove(SecurityContext::AUTHENTICATION_ERROR);
		}
		
		return $this->render('SidusBundle:User:login.html.twig', array(
			'last_username' => $session->get(SecurityContext::LAST_USERNAME),
			'error' => $error,
		));
	}

    public function homeAction() {
        return $this->forward('SidusBundle:Default:view',array('id_node'=>1));
    }

    public function notFoundAction() {
        //@TODO traduction
        $params = array('status_code' => 404, 'status_text' => 'Sorry, we were unable to find the requested node.');
        return $this->render('SidusBundle:Exception:error404.html.twig', $params)->setStatusCode(404);
    }

    public function noContentAction($node) {
        //@TODO traduction
        $params = array('status_code' => 418, 'status_text' => 'There seems to be no available content for this node.', 'node' => $node);
        return $this->render('SidusBundle:Exception:error418.html.twig', $params)->setStatusCode(418);
    }

    public function viewAction($id_node) {
		
		$node = $this->getNode($id_node);
				
		
        return $this->forward($node['object']->getType()->getController() . ':view', array(
            'node' => $node,
        ));

    }
	
	public function editAction($id_node) {
		
		$node = $this->getNode($id_node);
		
		return $this->forward($node['object']->getType()->getController() . ':edit',array(
                'node'=>$node,
                ));
	}
	
	public function chooseAction($id_node){
		/** @TODO Lorsqu'on clique sur une des icones -> forward vers addAction du type en question.
		 */
		
		$node = $this->getNode($id_node);
		
		$em = $this->getDoctrine()->getManager();
		
		$forbidden_types  = $node['object']->getType()->getForbiddenTypes();
		$authorized_types  = $node['object']->getType()->getAuthorizedTypes();
		
		if(!$forbidden_types->isEmpty()){
			$types = new \Doctrine\Common\Collections\ArrayCollection($em->getRepository('SidusBundle:Type')->findAll());
			foreach($forbidden_types->toArray() as $type){
				$types->removeElement($type);
			}
		}
		if(!$authorized_types->isEmpty()){
			$types = $authorized_types;
		}
		
		if($this->getRequest()->isMethod('POST')){
			// $this->getRequest()->request->keys() -> récupère le name du submit selectionner $type[0].':add', array('node' => $node,));
			$type=$this->getRequest()->request->keys();
			
			$user=$em->getRepository('SidusBundle:Node')->find(11);
			
			$new_node = new Node();
			$new_node->setParent($node['node']);
			$new_node->setCreatedBy($user);
			$new_node->setNodename('');
			$em->persist($new_node);
			$em->flush();
			//Créer une nouvelle node + version + objet (et type) et forward vers edit de la node nouvellement créer)
			
			return $this->redirect($this->generateUrl('sidus_add_node',array(
				'_locale'=>$node['node']->getCurrentVersion()->getLang(),
				'id_node'=>$new_node->getId(),
			)));
		}
		
		return $this->render('SidusBundle:Default:choose.html.twig',array(
            'node' => $node,
			'types'=>$types,
        ));
	}
	
	
	
	public function getNode($id_node){
		$em = $this->getDoctrine()->getManager();

		if($id_node == ''){
			$id_node=1;
		}
        $em = $this->getDoctrine()->getManager();
		$action = 'view';

		$node = $em->getRepository('SidusBundle:Node')->find($id_node);
        if (!$node) {
            return $this->forward('SidusBundle:Default:notFound');
        }

        //@TODO : Get permissions from ascendants (if necessary) and compile

        $versions = $em->getRepository('SidusBundle:Version')->findAllLastVersions($node);

        if (!$versions) {
            return $this->forward('SidusBundle:Default:noContent', array('node' => $node));
        }

        $languages = array();
        foreach ($versions as $version) {
            $languages[$version->getLang()] = $version;
        }
		
		
        $lang = $this->getRequest()->getLocale();

        if (!in_array($lang, $languages)) {
            $lang = $this->getRequest()->getPreferredLanguage(array_keys($languages));
            //@TODO traduction
            $this->getSession()->setFlash('warning', 'Sorry, this content is not available in your language.');
        }

        $node->setCurrentVersion($languages[$lang]);

		$ascendants=$em->getRepository('SidusBundle:Node')->getPath($node);
        //@TODO : récupérer les ascendants(+(createdby, modifiedby + version + node)) avec version + objet associés à chacune
		//->overwrite Gedmo\Tree\Entity\Repository\NestedTreeRepository getPathQueryBuilder($node)

        $descendants=$em->getRepository('SidusBundle:Node')->getChildren($node,true);
		//@TODO :récupérer les descendants avec version + objet associés.

        //@TODO : récupérer l'objet ET son type en une seule requête (Depuis quel repo ?)
        $object = $node->getCurrentVersion()->getObject();

		$request = $this->getRequest();
		if (!is_null($request->query->get('edit'))){
			$action='edit';
		}

		if (!is_null($request->query->get('add'))){
			return $this->forward('SidusBundle:Default:add', array(
            'node' => $node,
            'ascendants' => $ascendants,
			'descendants' => $descendants,
            'object' => $object,
        ));
		}

        return $this->forward($object->getType()->getController() . ':'.$action, array(
            'node' => $node,
            'ascendants' => $ascendants,
			'descendants' => $descendants,
            'object' => $object,
        ));

    }

	public function editAction($node) {
		return $this->render('SidusBundle:Default:edit.html.twig',array(
                'node'=>$node,
                ));
	}

	public function addAction($node,$ascendants,$descendants,$object){
		/* @TODO récupérer la liste des types autorisés (white list) ou de tout les types moins ceux interdit (black list)
			->Comment différencier white/black list?
		 * afficher les icones des types ajoutables (include Resources/views/{type}/icon.html.twig
		 * Lorsqu'on clique sur une des icones -> forward vers addAction du type en question.
		 */
		return $this->render('SidusBundle:Default:add.html.twig',array(
            'node' => $node,
            'ascendants' => $ascendants,
			'descendants' => $descendants,
            'object' => $object,
        ));
	}

    /**
     * Get the current session or create a new one
     * @return \Symfony\Component\HttpFoundation\Session\Session $session
     */
    public function getSession() {
        $session = $this->getRequest()->getSession();
        if (!$session) {
            $session = new \Symfony\Component\HttpFoundation\Session\Session;
            $session->start();
			$session->set('lang',$this->getRequest()->getLocale());
        }
        return $session;
    }

}
