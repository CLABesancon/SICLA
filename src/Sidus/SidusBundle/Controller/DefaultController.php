<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

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

        $lang = $this->getSession()->get('lang');//Retourne NULL ('lang' not set) Utiliser directement la "Locale" ?

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
	
	public function addAction($node){
		/* @TODO récupérer la liste des types autorisés (white list) ou de tout les types moins ceux interdit (black list)
			->Comment différencier white/black list?
		 * afficher les icones des types ajoutables (include Resources/views/{type}/icon.html.twig
		 * Lorsqu'on clique sur une des icones -> forward vers addAction du type en question.
		 */
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
        }
        return $session;
    }

}
