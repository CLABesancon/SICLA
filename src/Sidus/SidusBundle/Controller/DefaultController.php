<?php

namespace Sidus\SidusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller {

    public function homeAction() {
        // A récupérer : node 'root' (nodename);
        $em = $this->getDoctrine()->getManager();
        $node = $em->getRepository('SidusBundle:Node')->find(1);
        if (!$node) {
            return $this->forward('SidusBundle:Default:notFound');
        }
        return $this->render('SidusBundle:Default:home.html.twig', array('node' => $node));
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
        $em = $this->getDoctrine()->getManager();
       
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
        //@TODO : récupérer les ascendant avec version + objet associés à chacune
		//->overwrite Gedmo\Tree\Entity\Repository\NestedTreeRepository getPathQueryBuilder($node)
        
        
        
        //@TODO : récupérer l'objet ET son type en une seule requête (Depuis quel repo ?) 
        $object = $node->getCurrentVersion()->getObject();

        return $response = $this->forward($object->getType()->getController() . ':view', array(
            'node' => $node,
            'ascendants' => $ascendants,
            'object' => $object,
            'version' => $node->getCurrentVersion(),
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
        }
        return $session;
    }

}
