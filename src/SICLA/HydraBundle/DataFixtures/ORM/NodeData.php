<?php
namespace Sidus\HydraBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Node;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class NodeData extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface  {
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
		
		$types = array('Person');
		foreach ($types as $type) {
			$node= new Node();
			$node->setNodeName('type-'.strtolower($type));
			$node->setParent($this->container->get('doctrine')->getRepository('SidusBundle:Node')->find(4));
			$manager->persist($node);
			$this->addReference('node-type-'.strtolower($type),$node);
		}

		$manager->flush();

	}

	public function getOrder() {
		return 15;
	}
}


