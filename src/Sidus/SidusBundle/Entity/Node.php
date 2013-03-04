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
     * @ORM\ManyToOne(targetEntity="Sidus\SidusBundle\Entity\User")
     * @ORM\JoinColumn(nullable=false)
     * @Assert\NotBlank()
     */
    private $createdBy;

    /**
     * @ORM\Column(name="nodename", type="string", length=255)
     * @ORM\JoinColumn(nullable=true)
     */
    private $nodeName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="Sidus\SidusBundle\Entity\User")
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
     * @var Node[]
     * @ORM\OneToMany(targetEntity="Sidus\SidusBundle\Entity\Node", mappedBy="parent", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $children;

    /**
     * @var Node
     * @ORM\ManyToOne(targetEntity="Sidus\SidusBundle\Entity\Node", inversedBy="children", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

    /**
     * @var Versions[]
     * @ORM\OneToMany(targetEntity="Sidus\SidusBundle\Entity\Version", mappedBy="node", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $versions;

    /**
     * Last version for each language
     * @var Version[]
     */
    protected $last_versions;

    /**
     * The current version corresponding to either: what the controller loaded
     * or what the last version for the preferred language.
     * @var Version
     */
    protected $current_version;

    /**
     * Constructor
     */
    public function __construct() {
        $this->createdAt = new \DateTime('now');
        $this->modifiedAt = new \DateTime('now');
        $this->children = new \Doctrine\Common\Collections\ArrayCollection();
        $this->versions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->parent = null;
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
     * Set nodeName
     *
     * @param string $nodeName
     * @return Node
     */
    public function setNodeName($nodeName) {
        $this->nodeName = $nodeName;

        return $this;
    }

    /**
     * Get nodeName
     *
     * @return string
     */
    public function getNodeName() {
        return $this->nodeName;
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
     * @param Node $parent
     * @return Node
     */
    public function setParent(Node $parent) {
        $this->parent = $parent;
        return $this;
    }

    /**
     * Get parent
     *
     * @return Node
     */
    public function getParent() {
        if ($this->id != 1) {
            return $this->parent;
        } else {
            return null;
        }
    }

    public function getAscendants() {
        $result = new \Doctrine\Common\Collections\ArrayCollection(); //Array of ascendants nodes
        $tmp = $this;
        while ($tmp->getParent()) {
            $tmp = $tmp->getParent();
            $result->add($tmp);
        }
        return $result;
    }

    /**
     * Add child
     *
     * @param Node $child
     * @return Node
     */
    public function addChild(Node $child) {
        $this->children[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param Node $child
     */
    public function removeChild(Node $child) {
        $this->children->removeElement($child);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getChildren() {
        return $this->children;
    }

    /**
     * Add versions
     *
     * @param Version $versions
     * @return Node
     */
    public function addVersion(Version $versions) {
        $this->versions[] = $versions;

        return $this;
    }

    /**
     * Remove versions
     *
     * @param Version $versions
     */
    public function removeVersion(Version $versions) {
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

    /**
     * Return the last version for each available language
     * @return Versions[]
     */
    /**
      public function getLastVersions(){
      if(!$this->last_versions){
      $em = $this->getEntityManager(); // @todo BORDEL COMMENT ON FAIT ??? --> dans le repository
      $this->last_versions = $em->getRepository('SidusBundle:Version')->findAllLastVersions($this);
      }
      return $this->last_versions;
      }
     */

    /**
     * @todo Return the version with the proper language
     * @return Version
     */
    public function getDefaultVersion() {
        $versions = $this->getLastVersions();
        return array_pop($versions);
    }

    /**
     *
     * @return Version
     */
    public function getCurrentVersion() {
        if (!$this->current_version) {
            return $this->getDefaultVersion();
        }
        return $this->current_version;
    }

    /**
     *
     * @param Version $version
     * @return Node
     */
    public function setCurrentVersion(Version $version) {
        $this->current_version = $version;
        return $this;
    }

    public function getObject($version = null) {
        
    }

    /**
     *
     * @return string
     */
    public function __toString() {
        try {
            return (string) $this->getObject();
        } catch (ErrorException $e) {
            return (string) $this->getNodeName();
        }
    }

}