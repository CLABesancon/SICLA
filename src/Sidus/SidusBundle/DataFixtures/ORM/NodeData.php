<?php
namespace Sidus\SidusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Node;

class NodeData extends AbstractFixture implements OrderedFixtureInterface {
	
	public function load(ObjectManager $manager) {
		$now = new \Datetime('now');
		
		//Home
		$node_root = new Node();
		$node_root->setNodeName('home');
		
		$this->addReference('node-root',$node_root);
		
		//User Admin
		$node_user = new Node();
		$node_user->setNodeName('');
		$node_user->setCreatedBy($node_user);
		$node_user->setModifiedBy($node_user);
		
		$this->addReference('node-user',$node_user);
		
		$node_root->setCreatedBy($node_user);
		$node_root->setModifiedBy($node_user);
		
		$manager->persist($node_root);
		$manager->persist($node_user);
		
		//Users Folder
		$node_users = new Node();
		$node_users->setNodeName('users');
		$node_users->setCreatedBy($node_user);
		$node_users->setModifiedBy($node_user);
		$node_users->setParent($node_root);
		$manager->persist($node_users);
		$this->addReference('node-users',$node_users);
		
		$node_user->setParent($node_users);
		
		
		//Types Folder
		$node_types = new Node();
		$node_types->setNodeName('types');
		$node_types->setCreatedBy($node_user);
		$node_types->setModifiedBy($node_user);
		$node_types->setParent($node_root);
		$manager->persist($node_types);
		$this->addReference('node-types',$node_types);
		
		
		//Type "Type"
		$node_type = new Node();
		$node_type->setNodeName('type-type');
		$node_type->setCreatedBy($node_user);
		$node_type->setModifiedBy($node_user);
		$node_type->setParent($node_types);
		$manager->persist($node_type);
		$this->addReference('node-type-type',$node_type);

		$types = array('User','Root','Page','Folder');
		foreach ($types as $type) {
			$node= new Node();
			$node->setNodeName('type-'.strtolower($type));
			$node->setCreatedBy($node_user);
			$node->setModifiedBy($node_user);
			$node->setParent($node_types);
			$manager->persist($node);
			$this->addReference('node-type-'.strtolower($type),$node);
		}
		
		$manager->flush();
		
	}

	public function getOrder() {
		return 2;
	}
}


