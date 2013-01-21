<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Object
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sidus\SidusBundle\Entity\ObjectRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="typename", type="string")
 * @ORM\DiscriminatorMap({
 *  "core_user"="User",
 *  "core_metadata"="Metadata"
 * })
 */
class Object {

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\OneToMany(targetEntity="Sidus\SidusBundle\Entity\Version", mappedBy="object", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $versions;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->versions = new \Doctrine\Common\Collections\ArrayCollection();
	}

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Add versions
	 *
	 * @param \Sidus\SidusBundle\Entity\Version $versions
	 * @return Object
	 */
	public function addVersion(\Sidus\SidusBundle\Entity\Version $versions) {
		$this->versions[] = $versions;

		return $this;
	}

	/**
	 * Remove versions
	 *
	 * @param \Sidus\SidusBundle\Entity\Version $versions
	 */
	public function removeVersion(\Sidus\SidusBundle\Entity\Version $versions) {
		$this->versions->removeElement($versions);
	}

	/**
	 * Get versions
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getVersions() {
		return $this->versions;
	}

}