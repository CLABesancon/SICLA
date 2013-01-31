<?php
namespace Sidus\SidusBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Sidus\SidusBundle\Entity\Node;
use Sidus\SidusBundle\Entity\Version;
use Sidus\SidusBundle\Entity\Object;
use Sidus\SidusBundle\Entity\User;
use Sidus\SidusBundle\Entity\Page;

class InitData implements FixtureInterface{
	public function load(ObjectManager $manager) {
		$now = new \Datetime('now');
		$user=new User();
		$user->setTitle('Admin');
		$user->SetUsername('admin');
		$user->setPassword('admin');
		$user->setSalt('salt');
		$user->setEmail('email@admin.com');
		$user->setExpireAt($now->format('Y-m-d H:i:s'));
		$manager->persist($user);
		
		$node_root = new Node();
		$node_root->setNodeName('home');
		$node_root->setCreatedBy($user);
		$node_root->setModifiedBy($user);
		$manager->persist($node_root);
		
		$object_root = new Page();
		$object_root->setTitle('Home');
		$object_root->setContent('Hello World !');
		$object_root->setTags('root, home, hello');
		$manager->persist($object_root);
		
		$manager->flush();
		
		$version_root = new Version();
		$version_root->setNode($node_root);
		$version_root->setObject($object_root);
		$version_root->setLang('en');
		$version_root->setRevision(1);
		$version_root->setRevisionDate($now);
		$manager->persist($version_root);
		
		$node_users = new Node();
		$node_users->setNodeName('users');
		$node_users->setCreatedBy($user);
		$node_users->setModifiedBy($user);
		$node_users->setParent($node_root);
		$manager->persist($node_users);
		
		$object_users = new Page();
		$object_users->setTitle('Users');
		$object_users->setContent('List of Users');
		$object_users->setTags('user, users, folder');
		$manager->persist($object_users);
		
		$manager->flush();
		
		$version_users = new Version();
		$version_users->setNode($node_users);
		$version_users->setObject($object_users);
		$version_users->setLang('en');
		$version_users->setRevision(1);
		$version_users->setRevisionDate($now);
		$manager->persist($version_users);
		
		$manager->flush();
		
		$node_user = new Node();
		$node_user->setNodeName('');
		$node_user->setCreatedBy($user);
		$node_user->setModifiedBy($user);
		$node_user->setParent($node_users);
		$manager->persist($node_user);
		
		$manager->flush();
		
		$version_user = new Version();
		$version_user->setNode($node_user);
		$version_user->setObject($user);
		$version_user->setLang('en');
		$version_user->setRevision(1);
		$version_user->setRevisionDate($now);
		$manager->persist($version_user);
		
		$manager->flush();
	}
}


