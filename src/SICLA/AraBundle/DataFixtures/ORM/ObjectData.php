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
		$types = array('Proprietaire','Logement');
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
		
		// affectation demande de logement 
		$object_affectation_demande=new Type();
		$object_affectation_demande->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
		$object_affectation_demande->setTitle('Type Affectation des demandes de logements');
		$object_affectation_demande->setController('SICLAAraBundle:AffectationDemande');
		$object_affectation_demande->setTypeName('Type Affectation des Demandes de logement');
		$object_affectation_demande->addForbiddenType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(2));
		$manager->persist($object_affectation_demande);
		$this->addReference('object-type-affectationdemandeslogement',$object_affectation_demande);
		
		// apprenant
		$object_apprenant=new Type();
		$object_apprenant->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
		$object_apprenant->setTitle('Type Apprenant : Demande de logement');
		$object_apprenant->setController('SICLAAraBundle:ApprenantDemandeLogement');
		$object_apprenant->setTypeName('Type Apprenant : Demande de logement');
		$object_apprenant->addForbiddenType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(2));
		$manager->persist($object_apprenant);
		$this->addReference('object-type-apprenantdemandedelogement',$object_apprenant);
		
		// famille d'accueil
		
		$object_famille=new Type();
		$object_famille->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
		$object_famille->setTitle('Type Famille d\'accueil');
		$object_famille->setController('SICLAAraBundle:FamilleAccueil');
		$object_famille->setTypeName('Type  Famille d\'accueil');
		$object_famille->addForbiddenType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(2));
		$manager->persist($object_famille);
		$this->addReference('object-type-familledaccueil', $object_famille);
		
		
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
		
		//Folder Propriétaire
		
		$object_folder_proprietaire= new Type();
		$object_folder_proprietaire->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
		$object_folder_proprietaire->setTitle('Type Folder Propriétaires');
		$object_folder_proprietaire->setController('SICLAAraBundle:FolderProprietaire');
		$object_folder_proprietaire->setTypename($type);
		$object_folder_proprietaire->addAuthorizedType($this->getReference('object-type-proprietaire'));
		$manager->persist($object_folder_proprietaire);
		$this->addReference('object-type-folderproprietaire',$object_folder_proprietaire);
		
		//Folder apprenants demandes de logements
		
		$object_folder_demande_apprenant= new Type();
		$object_folder_demande_apprenant->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
		$object_folder_demande_apprenant->setTitle('Type Folder Apprenants');
		$object_folder_demande_apprenant->setController('SICLAAraBundle:FolderApprenant');
		$object_folder_demande_apprenant->setTypename($type);
		$object_folder_demande_apprenant->addAuthorizedType($this->getReference('object-type-apprenantdemandedelogement'));
		$manager->persist($object_folder_demande_apprenant);
		$this->addReference('object-type-folderapprenant',$object_folder_demande_apprenant);
		
		//Folders Annonces 
		
		$annonces = array('Annonces','Petites annonces');
		foreach ($annonces as $annonce) {
			$object_annonce = new Type();
			$object_annonce->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
			$object_annonce->setTitle('Type '.$annonce);
			$object_annonce->setController('SICLAAraBundle:'.str_replace(' ','',ucwords($annonce)));
			$object_annonce->setTypename($annonce);
			$object_annonce->addAuthorizedType($this->getReference('object-type-logement'));
			$manager->persist($object_annonce);
			$this->addReference('object-type-'.str_replace(' ','',strtolower($annonce)),$object_annonce);
		}
		
		//Folder famille accueil
		
		$object_folder_famille_accueil= new Type();
		$object_folder_famille_accueil->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
		$object_folder_famille_accueil->setTitle('Type Folder Famille Accueil');
		$object_folder_famille_accueil->setController('SICLAAraBundle:FolderFamilleAccueil');
		$object_folder_famille_accueil->setTypename($type);
		$object_folder_famille_accueil->addAuthorizedType($this->getReference('object-type-familledaccueil'));
		$manager->persist($object_folder_famille_accueil);
		$this->addReference('object-type-folderfamilleaccueil',$object_folder_famille_accueil);
		
		//Folder Affectation Demande de logement
		
		$object_folder_affectation = new Type();
		$object_folder_affectation->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
		$object_folder_affectation->setTitle('Type Folder Affectation Demandes de Logement');
		$object_folder_affectation->setController('SICLAAraBundle:FolderAffectationDemande');
		$object_folder_affectation->setTypename($type);
		$object_folder_affectation->addAuthorizedType($this->getReference('object-type-affectationdemandeslogement'));
		$manager->persist($object_folder_affectation);
		$this->addReference('object-type-folderaffectationdemandeslogement',$object_folder_affectation);
		
		//Liste des propriétaires
		$object_liste_proprietaires = new Folder();
		$object_liste_proprietaires->setTitle('Liste des propriétaires');
		$object_liste_proprietaires->setContent('Liste des propriétaires');
		$object_liste_proprietaires->setTags('propriétaires, folder');
		$object_liste_proprietaires->setType($this->getReference('object-type-folderproprietaire'));
		$manager->persist($object_liste_proprietaires);
		$this->addReference('object-liste-proprietaires',$object_liste_proprietaires);
		
		//Liste des demandes d'apprenants
		$object_liste_apprenants = new Folder();
		$object_liste_apprenants->setTitle('Liste des demandes de logement d\'apprenants');
		$object_liste_apprenants->setContent('Liste des demandes de logement d\'apprenants');
		$object_liste_apprenants->setTags('apprenants, folder');
		$object_liste_apprenants->setType($this->getReference('object-type-folderapprenant'));
		$manager->persist($object_liste_apprenants);
		$this->addReference('object-liste-apprenants',$object_liste_apprenants);
		
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
		
		//Liste des familles d'accueil
		$object_liste_familles= new Folder();
		$object_liste_familles->setTitle("Liste des familles d'accueil");
		$object_liste_familles->setContent("Liste des familles d'accueil");
		$object_liste_familles->setTags('familles, folder');
		$object_liste_familles->setType($this->getReference('object-type-folderfamilleaccueil'));
		$manager->persist($object_liste_familles);
		$this->addReference('object-liste-famillesaccueil',$object_liste_familles);
		
		//Liste des affectations de demandes de logement 
		$object_liste_affectations= new Folder();
		$object_liste_affectations->setTitle("Liste des affectations de demandes de logement");
		$object_liste_affectations->setContent("Liste des affectations de demandes de logement");
		$object_liste_affectations->setTags('affectations, demandes, folder');
		$object_liste_affectations->setType($this->getReference('object-type-folderaffectationdemandeslogement'));
		$manager->persist($object_liste_affectations);
		$this->addReference('object-liste-affectationsdemandeslogement',$object_liste_affectations);
		
		$manager->flush();
		
	}
	
	public function getOrder() {
		return 11;
	}
}