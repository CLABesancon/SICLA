<?php
namespace Sidus\AraBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Version;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;


class VersionData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface {
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
		$user = $this->container->get('doctrine')->getRepository('SidusBundle:Node')->find(2);

		//Other Types
		$types = array('Apprenant demande de logement','Famille d accueil','Proprietaire','Logement','Folder Logement','Folder Apprenant','Folder Proprietaire', 'Folder Famille Accueil','Annonces','Petites annonces');
		foreach ($types as $type) {
			$version = new Version();
			$version->setNode($this->getReference('node-type-'.str_replace(' ','',strtolower($type))));
			$version->setObject($this->getReference('object-type-'.str_replace(' ','',strtolower($type))));
			$version->setLang('fr');
			$version->setRevision(1);
			$version->setRevisionDate($now);
			$version->setRevisionBy($user);
			$manager->persist($version);
		}
		
		// Folder Ara
		
		$version_ara = new Version();
		$version_ara->setNode($this->getReference('node-ara'));
		$version_ara->setObject($this->getReference('object-ara'));
		$version_ara->setLang('en');
		$version_ara->setRevision(1);
		$version_ara->setRevisionDate($now);
		$version_ara->setRevisionBy($user);
		$manager->persist($version_ara);
		
		
		//Liste des logements
		$version_liste_logements = new Version();
		$version_liste_logements->setNode($this->getReference('node-liste-logements'));
		$version_liste_logements->setObject($this->getReference('object-liste-logements'));
		$version_liste_logements->setLang('en');
		$version_liste_logements->setRevision(1);
		$version_liste_logements->setRevisionDate($now);
		$version_liste_logements->setRevisionBy($user);
		$manager->persist($version_liste_logements);
		
		//Liste des propriétaires
		$version_liste_proprietaires= new Version();
		$version_liste_proprietaires->setNode($this->getReference('node-liste-proprietaires'));
		$version_liste_proprietaires->setObject($this->getReference('object-liste-proprietaires'));
		$version_liste_proprietaires->setLang('en');
		$version_liste_proprietaires->setRevision(1);
		$version_liste_proprietaires->setRevisionDate($now);
		$version_liste_proprietaires->setRevisionBy($user);
		$manager->persist($version_liste_proprietaires);
		
		//Liste des demandes d'hébergement des apprenants
		$version_liste_apprenants= new Version();
		$version_liste_apprenants->setNode($this->getReference('node-liste-apprenants'));
		$version_liste_apprenants->setObject($this->getReference('object-liste-apprenants'));
		$version_liste_apprenants->setLang('en');
		$version_liste_apprenants->setRevision(1);
		$version_liste_apprenants->setRevisionDate($now);
		$version_liste_apprenants->setRevisionBy($user);
		$manager->persist($version_liste_apprenants);
		
		// Liste des annonces validées
		$version_liste_annonces = new Version();
		$version_liste_annonces->setNode($this->getReference('node-liste-annonces'));
		$version_liste_annonces->setObject($this->getReference('object-liste-annonces'));
		$version_liste_annonces->setLang('en');
		$version_liste_annonces->setRevision(1);
		$version_liste_annonces->setRevisionDate($now);
		$version_liste_annonces->setRevisionBy($user);
		$manager->persist($version_liste_annonces);
		
		// Liste des annonces à valider
		$version_liste_petites_annonces = new Version();
		$version_liste_petites_annonces->setNode($this->getReference('node-liste-petites-annonces'));
		$version_liste_petites_annonces->setObject($this->getReference('object-liste-petites-annonces'));
		$version_liste_petites_annonces->setLang('en');
		$version_liste_petites_annonces->setRevision(1);
		$version_liste_petites_annonces->setRevisionDate($now);
		$version_liste_petites_annonces->setRevisionBy($user);
		$manager->persist($version_liste_petites_annonces);
		
		// Liste des familles d'accueil
		$version_liste_familles = new Version();
		$version_liste_familles->setNode($this->getReference('node-liste-famillesaccueil'));
		$version_liste_familles->setObject($this->getReference('object-liste-famillesaccueil'));
		$version_liste_familles->setLang('en');
		$version_liste_familles->setRevision(1);
		$version_liste_familles->setRevisionDate($now);
		$version_liste_familles->setRevisionBy($user);
		$manager->persist($version_liste_familles);
		
		$manager->flush();
	}

	public function getOrder() {
		return 13;
	}
}