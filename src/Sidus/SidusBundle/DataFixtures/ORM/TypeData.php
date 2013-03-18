<?php
namespace Sidus\SidusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class TypeData extends AbstractFixture implements OrderedFixtureInterface {
	
	public function load(ObjectManager $manager) {

		$root = $this->getReference('object-type-root');
		$type = $this->getReference('object-type-type');
		$folder = $this->getReference('object-type-folder');
		$page = $this->getReference('object-type-page');
		$user = $this->getReference('object-type-user');
		
		$root->addAuthorizedType($folder);
		$root->addAuthorizedType($page);
		$folder->addForbiddenType($root);
		$page->addForbiddenType($root);
		$type->addForbiddenType($root);
		$user->addForbiddenType($root);
		$manager->flush();
		
	}

	public function getOrder() {
		return 4;
	}
}