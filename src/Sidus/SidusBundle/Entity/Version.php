<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Version
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sidus\SidusBundle\Entity\VersionRepository")
 */
class Version {

	/**
	 * @ORM\ManyToOne(targetEntity="Sidus\SidusBundle\Entity\Node", inversedBy="versions", cascade={"persist"})
	 * @ORM\JoinColumn(name="node_id", referencedColumnName="id")
	 * @ORM\Id
	 */
	private $node;

	/**
	 * @ORM\ManyToOne(targetEntity="Sidus\SidusBundle\Entity\Object")
	 * @ORM\JoinColumn(name="object_id", referencedColumnName="id")
	 * @ORM\Id
	 */
	private $object;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="lang", type="string", length=3)
	 * @ORM\Id
	 */
	private $lang;

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="revision", type="integer")
	 * @ORM\Id
	 * @Assert\NotBlank()
	 * @Assert\DateTime()
	 */
	private $revision;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="revision_date", type="datetime")
	 * @Assert\NotBlank()
	 * @Assert\DateTime()
	 */
	private $revision_date;
	
	    /**
     * @ORM\ManyToOne(targetEntity="Sidus\SidusBundle\Entity\Node")
     * @ORM\JoinColumn()
     * @Assert\NotBlank()
     */
    private $revisionBy;

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set revision_date
	 *
	 * @param \DateTime $revision_date
	 * @return Version
	 */
	public function setRevision_Date($revision_date) {
		$this->revisionDate = $revision_date;

		return $this;
	}

	/**
	 * Get revision_date
	 *
	 * @return \DateTime 
	 */
	public function getRevision_Date() {
		return $this->revisionDate;
	}
	
	 /**
     * Set revision_by
     *
     * @param integer $revisionBy
     * @return Node
     */
    public function setRevisionBy($revisionBy) {
        $this->revisionBy = $revisionBy;
        return $this;
    }

    /**
     * Get revision_by
     *
     * @return integer
     */
    public function getRevisionBy() {
        return $this->revisionBy;
    }
	
	/**
	 * Set lang
	 *
	 * @param string $lang
	 * @return Version
	 */
	public function setLang($lang) {
		$this->lang = $lang;

		return $this;
	}

	/**
	 * Get lang
	 *
	 * @return string 
	 */
	public function getLang() {
		return $this->lang;
	}

	/**
	 * Set revision
	 *
	 * @param integer $revision
	 * @return Version
	 */
	public function setRevision($revision) {
		$this->revision = $revision;

		return $this;
	}

	/**
	 * Get revision
	 *
	 * @return integer 
	 */
	public function getRevision() {
		return $this->revision;
	}

	/**
	 * Set node
	 *
	 * @param \Sidus\SidusBundle\Entity\Node $node
	 * @return Version
	 */
	public function setNode(\Sidus\SidusBundle\Entity\Node $node) {
		$this->node = $node;

		return $this;
	}

	/**
	 * Get node
	 *
	 * @return \Sidus\SidusBundle\Entity\Node 
	 */
	public function getNode() {
		return $this->node;
	}

	/**
	 * Set object
	 *
	 * @param \Sidus\SidusBundle\Entity\Object $object
	 * @return Version
	 */
	public function setObject(\Sidus\SidusBundle\Entity\Object $object) {
		$this->object = $object;

		return $this;
	}

	/**
	 * Get object
	 *
	 * @return \Sidus\SidusBundle\Entity\Object 
	 */
	public function getObject() {
		return $this->object;
	}

}