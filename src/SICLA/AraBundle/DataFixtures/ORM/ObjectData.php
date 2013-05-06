<?php
namespace Sidus\AraBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Type;
use Sidus\SidusBundle\Entity\Folder;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class ObjectData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface {
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
		$now = new \Datetime('now');
         
		//Other Types
		$types = array('Apprenant demande de logement','Famille d\'accueil','Proprietaire','Logement','Annonce');
		foreach ($types as $type) {
			$object = new Type();
			$object->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
			$object->setTitle('Type '.$type);
			$object->setController('SICLAAraBundle:'.$type);
			$object->setTypename($type);
			$object->addForbiddenType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(2));
			$manager->persist($object);
			$this->addReference('object-type-'.str_replace(' ','',strtolower($type)),$object);
		}
		
		// Folder Ara
		$object_ara = new Folder();
		$object_ara->setTitle('Ara');
		$object_ara->setContent('Contenu de Ara');
		$object_ara->setTags('ara,folder');
		$object_ara->setType($this->container->get('doctrine')->getRepository('SidusBundle:Object')->findOneBy(array('title' => 'Type Folder')));
		$manager->persist($object_ara);
		$this->addReference('object-ara',$object_ara);
		
		//Folder Logement
		
		$object_folder_logement = new Type();
		$object_folder_logement->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
		$object_folder_logement->setTitle('Type Folder Logement');
		$object_folder_logement->setController('SICLAAraBundle:FolderLogement');
		$object_folder_logement->setTypename($type);
		$object_folder_logement->addAuthorizedType($this->getReference('object-type-logement'));
		$manager->persist($object_folder_logement);
		$this->addReference('object-type-folderlogement',$object_folder_logement);
		
		//Folders Annonces 
		
		$annonces = array('Annonces','Petites annonces');
		foreach ($annonces as $annonce) {
			$object_annonce = new Type();
			$object_annonce->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
			$object_annonce->setTitle('Type '.$annonce);
			$object_annonce->setController('SICLAAraBundle:'.str_replace(' ','',ucwords($annonce)));
			$object_annonce->setTypename($annonce);
			$object_annonce->addAuthorizedType($this->getReference('object-type-annonce'));
			$manager->persist($object_annonce);
			$this->addReference('object-type-'.str_replace(' ','',strtolower($annonce)),$object_annonce);
		}
		
		//Liste des logements
		$object_liste_logements = new Folder();
		$object_liste_logements->setTitle('Liste des Logements');
		$object_liste_logements->setContent('Liste des Logements');
		$object_liste_logements->setTags('logements, folder');
		$object_liste_logements->setType($this->getReference('object-type-folderlogement'));
		$manager->persist($object_liste_logements);
		$this->addReference('object-liste-logements',$object_liste_logements);
		
		//Liste de toutes les annonces
		$object_liste_annonces = new Folder();
		$object_liste_annonces->setTitle('Liste de toutes les annonces');
		$object_liste_annonces->setContent('Liste de toutes les annonces');
		$object_liste_annonces->setTags('annonces, annonce, valide, folder');
		$object_liste_annonces->setType($this->getReference('object-type-annonces'));
		$manager->persist($object_liste_annonces);
		$this->addReference('object-liste-annonces',$object_liste_annonces);
		
		// Liste des petites annonces
		$object_liste_petites_annonces = new Folder();
		$object_liste_petites_annonces->setTitle('Liste des petites annonces');
		$object_liste_petites_annonces->setContent('Liste des petites annonces');
		$object_liste_petites_annonces->setTags('annonces, annonce, valide, folder');
		$object_liste_petites_annonces->setType($this->getReference('object-type-petitesannonces'));
		$manager->persist($object_liste_petites_annonces);
		$this->addReference('object-liste-petites-annonces',$object_liste_petites_annonces);
		
		
		$manager->flush();
		
	}
	
	public function getOrder() {
		return 11;
	}
}