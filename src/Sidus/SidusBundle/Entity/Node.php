<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="sd_node")
 */
class Node {

	/**
	 * @ORM\Id
	 * @ORM\Column(type="bigint")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="bigint")
	 */
	protected $parent_id;

	/**
	 * @ORM\Column(type="bigint")
	 */
	protected $object_id;

	/**
	 * @ORM\Column(type="bigint")
	 */
	protected $object_type_id;

	/**
	 * @ORM\Column(type="boolean")
	 */
	protected $inherit_permissions = 1;

	/**
	 * @ManyToOne(targetEntity="Node")
	 * @JoinColumn(name="parent_id", referencedColumnName="id")
	 */
	private $parent;

	/**
	 * @ManyToOne(targetEntity="Object")
	 * @JoinColumn(name="object_id", referencedColumnName="id")
	 */
	private $object;

	/**
	 * @ManyToOne(targetEntity="ObjectType")
	 * @JoinColumn(name="object_type_id", referencedColumnName="id")
	 */
	private $object_type;
	
}
