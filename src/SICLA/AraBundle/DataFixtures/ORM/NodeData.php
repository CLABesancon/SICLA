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
		
		$types = array('Apprenant demande de logement','Famille d accueil','Proprietaire','Logement','Folder Logement','Folder Proprietaire','Folder Apprenant', 'Folder Famille Accueil','Affectation Groupe','Affectation Logement','Affectation Demandes Logement','Folder Affectation Demandes Logement','Annonces','Petites annonces');
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
		
		//Liste des propriétaires
		$node_liste_proprietaires= new Node();
		$node_liste_proprietaires->setNodeName('Liste des propriétaires');
		$node_liste_proprietaires->setParent($node_ara);
		$manager->persist($node_liste_proprietaires);
		$this->addReference('node-liste-proprietaires',$node_liste_proprietaires);
		
		//Liste des demandes d'apprenants
		$node_liste_apprenants= new Node();
		$node_liste_apprenants->setNodeName('Liste des demandes d\hébergement des apprenants');
		$node_liste_apprenants->setParent($node_ara);
		$manager->persist($node_liste_apprenants);
		$this->addReference('node-liste-apprenants',$node_liste_apprenants);

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
		
		// Liste des familles d'accueil
		$node_liste_familles=new Node();
		$node_liste_familles->setNodeName("Liste des familles d'accueil");
		$node_liste_familles->setParent($node_ara);
		$manager->persist($node_liste_familles);
		$this->addReference('node-liste-famillesaccueil', $node_liste_familles);
		
		// Liste des affectations de demandes de logement
		$node_liste_affectation=new Node();
		$node_liste_affectation->setNodeName("Liste des affectations de demandes de logement");
		$node_liste_affectation->setParent($node_ara);
		$manager->persist($node_liste_affectation);
		$this->addReference('node-liste-affectationsdemandeslogement', $node_liste_affectation);
		
		
		$manager->flush();

	}

	public function getOrder() {
		return 12;
	}
}


