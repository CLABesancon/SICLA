<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Node
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sidus\SidusBundle\Entity\NodeRepository")
 */
class Node {

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @ORM\OneToOne(targetEntity="Sidus\SidusBundle\Entity\User", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 * @Assert\NotBlank()
	 */
	private $createdBy;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="created_at", type="datetime")
	 * @Assert\NotBlank()
	 * @Assert\DateTime()
	 */
	private $createdAt;

	/**
	 * @ORM\OneToOne(targetEntity="Sidus\SidusBundle\Entity\User", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 * @Assert\NotBlank()
	 */
	private $modifiedBy;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="modified_at", type="datetime")
	 * @Assert\NotBlank()
	 * @Assert\DateTime()
	 */
	private $modifiedAt;

	/**
	 * @ORM\OneToMany(targetEntity="Sidus\SidusBundle\Entity\Node", mappedBy="parent", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $childs;

	/**
	 * @ORM\ManytoOne(targetEntity="Sidus\SidusBundle\Entity\Node", inversedBy="childs", cascade={"persist"})
	 * @ORM\JoinColumn(name="parent_id", referencedColumnName="id")
	 */
	private $parent;

	/**
	 * @ORM\OneToMany(targetEntity="Sidus\SidusBundle\Entity\Version", mappedBy="node", cascade={"persist"})
	 * @ORM\JoinColumn(nullable=false)
	 */
	private $versions;

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->createdAt = new DateTime('now');
		$this->childs = new \Doctrine\Common\Collections\ArrayCollection();
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
	 * Set created_by
	 *
	 * @param integer $createdBy
	 * @return Node
	 */
	public function setCreatedBy($createdBy) {
		$this->createdBy = $createdBy;

		return $this;
	}

	/**
	 * Get created_by
	 *
	 * @return integer 
	 */
	public function getCreatedBy() {
		return $this->createdBy;
	}

	/**
	 * Set created_at
	 *
	 * @param \DateTime $createdAt
	 * @return Node
	 */
	public function setCreatedAt($createdAt) {
		$this->createdAt = $createdAt;

		return $this;
	}

	/**
	 * Get created_at
	 *
	 * @return \DateTime 
	 */
	public function getCreatedAt() {
		return $this->createdAt;
	}

	/**
	 * Set modified_by
	 *
	 * @param integer $modifiedBy
	 * @return Node
	 */
	public function setModifiedBy($modifiedBy) {
		$this->modifiedBy = $modifiedBy;

		return $this;
	}

	/**
	 * Get modified_by
	 *
	 * @return integer 
	 */
	public function getModifiedBy() {
		return $this->modifiedBy;
	}

	/**
	 * Set modified_at
	 *
	 * @param \DateTime $modifiedAt
	 * @return Node
	 */
	public function setModifiedAt($modifiedAt) {
		$this->modifiedAt = $modifiedAt;

		return $this;
	}

	/**
	 * Get modified_at
	 *
	 * @return \DateTime 
	 */
	public function getModifiedAt() {
		return $this->modifiedAt;
	}

	/**
	 * Set parent
	 *
	 * @param \Sidus\SidusBundle\Entity\Node $parent
	 * @return Node
	 */
	public function setParent(\Sidus\SidusBundle\Entity\Node $parent) {
		$this->parent = $parent;

		return $this;
	}

	/**
	 * Get parent
	 *
	 * @return \Sidus\SidusBundle\Entity\Node 
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Add childs
	 *
	 * @param \Sidus\SidusBundle\Entity\Node $childs
	 * @return Node
	 */
	public function addChild(\Sidus\SidusBundle\Entity\Node $childs) {
		$this->childs[] = $childs;

		return $this;
	}

	/**
	 * Remove childs
	 *
	 * @param \Sidus\SidusBundle\Entity\Node $childs
	 */
	public function removeChild(\Sidus\SidusBundle\Entity\Node $childs) {
		$this->childs->removeElement($childs);
	}

	/**
	 * Get childs
	 *
	 * @return \Doctrine\Common\Collections\Collection 
	 */
	public function getChilds() {
		return $this->childs;
	}

	/**
	 * Add versions
	 *
	 * @param \Sidus\SidusBundle\Entity\Version $versions
	 * @return Node
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