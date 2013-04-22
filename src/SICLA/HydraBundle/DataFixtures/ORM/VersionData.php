<?php
namespace Sidus\HydraBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Version;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class VersionData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface  {
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
		$types = array('Person');
		foreach ($types as $type) {
			$version = new Version();
			$version->setNode($this->getReference('node-type-'.strtolower($type)));
			$version->setObject($this->getReference('object-type-'.strtolower($type)));
			$version->setLang('en');
			$version->setRevision(1);
			$version->setRevisionDate($now);
			$version->setRevisionBy($user);
			$manager->persist($version);
		}
		$manager->flush();
	}

	public function getOrder() {
		return 16;
	}
}