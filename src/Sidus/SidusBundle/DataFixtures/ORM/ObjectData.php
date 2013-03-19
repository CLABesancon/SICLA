<?php
namespace Sidus\SidusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\User;
use Sidus\SidusBundle\Entity\Page;
use Sidus\SidusBundle\Entity\Folder;
use Sidus\SidusBundle\Entity\Type;

class ObjectData extends AbstractFixture implements OrderedFixtureInterface {
	
	public function load(ObjectManager $manager) {
		$now = new \Datetime('now');
		
		//Type "Type"
		$object_type = new Type();
		$object_type->setTitle('Type Type');
		$object_type->setController('SidusBundle:Type');
		$object_type->setTypename('Type');
		$object_type->setType($object_type);
		$object_type->addAuthorizedType($object_type);
		$manager->persist($object_type);
		$this->addReference('object-type-type',$object_type);
		
		//Type "Root"
		$object_type_root = new Type();
		$object_type_root->setType($object_type);
		$object_type_root->setTitle('Type Root');
		$object_type_root->setController('SidusBundle:Folder');
		$object_type_root->setTypename('Root');
		$object_type_root->setType($object_type);
		$manager->persist($object_type_root);
		$this->addReference('object-type-root',$object_type_root);
		
		$object_type->addForbiddenType($object_type_root);
                
		//Other Types
		$types = array('User','Page','Folder');	
		foreach ($types as $type) {
			$object = new Type();
			$object->setType($object_type);
			$object->setTitle('Type '.$type);
			$object->setController('SidusBundle:'.$type);
			$object->setTypename($type);
			$object->addForbiddenType($object_type_root);
			$manager->persist($object);
			$this->addReference('object-type-'.strtolower($type),$object);
		}
		
		$object_type_root->addAuthorizedType($this->getReference('object-type-folder'));
		$object_type_root->addAuthorizedType($this->getReference('object-type-page'));
		
		//Home
		$object_root = new Page();
		$object_root->setTitle('Home');
		$object_root->setContent('Hello World !');
		$object_root->setTags('root, home, hello');
		$object_root->setType($this->getReference('object-type-root'));
		$manager->persist($object_root);
		$this->addReference('object-root',$object_root);
		
		//Users Folder
		$object_users = new Folder();
		$object_users->setTitle('Users');
		$object_users->setContent('List of Users');
		$object_users->setTags('user, users, folder');
		$object_users->setType($this->getReference('object-type-folder'));
		$manager->persist($object_users);
		$this->addReference('object-users',$object_users);
		
		//Admin user
		$user=new User();
		$user->setTitle('Admin');
		$user->SetUsername('admin');
		$user->setPassword('admin');
		$user->setSalt('salt');
		$user->setEmail('email@admin.com');
		$user->setExpireAt($now->format('Y-m-d H:i:s'));
		$user->setType($this->getReference('object-type-user'));
		$manager->persist($user);
		$this->addReference('object-user',$user);
		
		//Types Folder
		$object_types = new Folder();
		$object_types->setTitle('Types');
		$object_types->setContent('List of Types');
		$object_types->setTags('type, types, folder');
		$object_types->setType($this->getReference('object-type-folder'));
		$manager->persist($object_types);
		$this->addReference('object-types',$object_types);
		
		$manager->flush();
		
	}

	public function getOrder() {
		return 1;
	}
}