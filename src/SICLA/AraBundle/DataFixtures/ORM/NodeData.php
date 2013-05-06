<?php
namespace SICLA\AraBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NodeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface {
	/**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritDoc}
     */
	
	public function load(ObjectManager $manager) {
		
		$types = array('Apprenant demande de logement','Famille d\'accueil','Proprietaire','Logement','Folder Logement','Annonce','Annonces','Petites annonces');
		foreach ($types as $type) {
			$node= new Node();
			$node->setNodeName('type-'.strtolower($type));
			$node->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->find(4));
			$manager->persist($node);
			$this->addReference('node-type-'.str_replace(' ','',strtolower($type)),$node);
		}
		
		// Folder Ara
		
		$node_ara=new Node();
		$node_ara->setNodeName('Folder Ara');
		$node_ara->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->find(1));
		$manager->persist($node_ara);
		$this->addReference('node-ara',$node_ara);
		
		//Liste des logements
		$node_liste_logements= new Node();
		$node_liste_logements->setNodeName('Liste des logements');
		$node_liste_logements->setParent($node_ara);
		$manager->persist($node_liste_logements);
		$this->addReference('node-liste-logements',$node_liste_logements);

		// Liste de toutes les annonces 
		$node_liste_annonces=new Node();
		$node_liste_annonces->setNodeName('Liste des annonces');
		$node_liste_annonces->setParent($node_ara);
		$manager->persist($node_liste_annonces);
		$this->addReference('node-liste-annonces', $node_liste_annonces);
		
		// Liste des petites annonces
		$node_liste_petites_annonces=new Node();
		$node_liste_petites_annonces->setNodeName('Liste des petites annonces');
		$node_liste_petites_annonces->setParent($node_ara);
		$manager->persist($node_liste_petites_annonces);
		$this->addReference('node-liste-petites-annonces', $node_liste_petites_annonces);
		
		$manager->flush();

	}

	public function getOrder() {
		return 12;
	}
}


