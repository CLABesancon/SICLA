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

class NodeData extends AbstractFixture implements OrderedFixtureInterface {
	
	public function load(ObjectManager $manager) {
		$now = new \Datetime('now');
		
		$user=$this->getReference('object-user');
		
		//Home
		$node_root = new Node();
		$node_root->setNodeName('home');
		$node_root->setCreatedBy($user);
		$node_root->setModifiedBy($user);
		$manager->persist($node_root);
		$this->addReference('node-root',$node_root);
		
		//Users Folder
		$node_users = new Node();
		$node_users->setNodeName('users');
		$node_users->setCreatedBy($user);
		$node_users->setModifiedBy($user);
		$node_users->setParent($node_root);
		$manager->persist($node_users);
		$this->addReference('node-users',$node_users);
		
		//User Admin
		$node_user = new Node();
		$node_user->setNodeName('');
		$node_user->setCreatedBy($user);
		$node_user->setModifiedBy($user);
		$node_user->setParent($node_users);
		$manager->persist($node_user);
		$this->addReference('node-user',$node_user);
		
		//Types Folder
		$node_types = new Node();
		$node_types->setNodeName('types');
		$node_types->setCreatedBy($user);
		$node_types->setModifiedBy($user);
		$node_types->setParent($node_root);
		$manager->persist($node_types);
		$this->addReference('node-types',$node_types);
		
		
		//Type "Type"
		$node_type = new Node();
		$node_type->setNodeName('type-type');
		$node_type->setCreatedBy($user);
		$node_type->setModifiedBy($user);
		$node_type->setParent($node_types);
		$manager->persist($node_type);
		$this->addReference('node-type-type',$node_type);

		$types = array('User','Root','Page','Folder');
		foreach ($types as $type) {
			$node= new Node();
			$node->setNodeName('type-'.strtolower($type));
			$node->setCreatedBy($user);
			$node->setModifiedBy($user);
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


