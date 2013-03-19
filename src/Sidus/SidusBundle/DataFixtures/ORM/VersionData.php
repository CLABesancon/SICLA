<?php
namespace Sidus\SidusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Node;
use Sidus\SidusBundle\Entity\Version;
use Sidus\SidusBundle\Entity\Object;
use Sidus\SidusBundle\Entity\User;
use Sidus\SidusBundle\Entity\Page;
use Sidus\SidusBundle\Entity\Folder;
use Sidus\SidusBundle\Entity\Type;

class VersionData extends AbstractFixture implements OrderedFixtureInterface {
	
	public function load(ObjectManager $manager) {
		$now = new \Datetime('now');
		$user = $this->getReference('node-user');
		
		//Home
		$version_root = new Version();
		$version_root->setNode($this->getReference('node-root'));
		$version_root->setObject($this->getReference('object-root'));
		$version_root->setLang('en');
		$version_root->setRevision(1);
		$version_root->setRevision_Date($now);
		$version_root->setRevisionBy($user);
		$manager->persist($version_root);
		
		//Users Folder
		$version_users = new Version();
		$version_users->setNode($this->getReference('node-users'));
		$version_users->setObject($this->getReference('object-users'));
		$version_users->setLang('en');
		$version_users->setRevision(1);
		$version_users->setRevision_Date($now);
		$version_users->setRevisionBy($user);
		$manager->persist($version_users);
		
		//User Admin
		$version_user = new Version();
		$version_user->setNode($this->getReference('node-user'));
		$version_user->setObject($this->getReference('object-user'));
		$version_user->setLang('en');
		$version_user->setRevision(1);
		$version_user->setRevision_Date($now);
		$version_user->setRevisionBy($user);
		$manager->persist($version_user);
		
		//Types Folders
		$version_types = new Version();
		$version_types->setNode($this->getReference('node-types'));
		$version_types->setObject($this->getReference('object-types'));
		$version_types->setLang('en');
		$version_types->setRevision(1);
		$version_types->setRevision_Date($now);
		$version_types->setRevisionBy($user);
		$manager->persist($version_types);
		
		//Type "Type"
		$version_type = new Version();
		$version_type->setNode($this->getReference('node-type-type'));
		$version_type->setObject($this->getReference('object-type-type'));
		$version_type->setLang('en');
		$version_type->setRevision(1);
		$version_type->setRevision_Date($now);
		$version_type->setRevisionBy($user);
		$manager->persist($version_type);
		
		//Other Types
		$types = array('User','Root','Page','Folder');
		foreach ($types as $type) {
			$version = new Version();
			$version->setNode($this->getReference('node-type-'.strtolower($type)));
			$version->setObject($this->getReference('object-type-'.strtolower($type)));
			$version->setLang('en');
			$version->setRevision(1);
			$version->setRevision_Date($now);
			$version->setRevisionBy($user);
			$manager->persist($version);
		}
		$manager->flush();
	}

	public function getOrder() {
		return 3;
	}
}