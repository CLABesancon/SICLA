<?php
namespace Sidus\AraBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Type;
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
		$types = array('ApprenantDemandeLogement','FamilleAccueil','Logement','Proprietaire','FolderLogement','Annonce');
		foreach ($types as $type) {
			$object = new Type();
			$object->setType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(1));
			$object->setTitle('Type '.$type);
			$object->setController('SICLAAraBundle:'.$type);
			$object->setTypename($type);
			$object->addForbiddenType($this->container->get('doctrine')->getRepository('SidusBundle:Type')->find(2));
			$manager->persist($object);
			$this->addReference('object-type-'.strtolower($type),$object);
		}
		
		$manager->flush();
		
	}

	public function getOrder() {
		return 11;
	}
}