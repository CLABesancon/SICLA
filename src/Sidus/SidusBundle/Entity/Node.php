<?php

namespace Sidus\SidusBundle\Entity;

use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Node
 *
 * @Gedmo\Tree(type="nested")
 * @ORM\Table(name="node")
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
     * @ORM\Column(name="node_name", type="string", length=255)
     * @ORM\JoinColumn(nullable=true)
     */
    private $nodeName;

    /**
     * @var Node[]
     * @ORM\OneToMany(targetEntity="Sidus\SidusBundle\Entity\Node", mappedBy="parent", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     * @ORM\OrderBy({"lft" = "ASC"})
     */
    private $children;

    /**
     * @var Node
     * @Gedmo\TreeParent
     * @ORM\ManyToOne(targetEntity="Sidus\SidusBundle\Entity\Node", inversedBy="children", cascade={"persist"})
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=true)
     */
    private $parent;

	/**
     * @var integer
     * @ORM\Column(name="parent_id", type="integer")
     */
    private $parentId;

    /**
     * @var Versions[]
     * @ORM\OneToMany(targetEntity="Sidus\SidusBundle\Entity\Version", mappedBy="node", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $versions;

    /**
     * Nested Tree configuration
     */

    /**
    * @Gedmo\TreeLeft
    * @ORM\Column(name="lft", type="integer")
    */
   private $lft;

   /**
    * @Gedmo\TreeRight
    * @ORM\Column(name="rgt", type="integer")
    */
   private $rgt;

   /**
    * @Gedmo\TreeLevel
    * @ORM\Column(name="lvl", type="integer")
    */
   private $lvl;


    /**
     * Constructor
     */
    public function __construct() {
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


    /**
     * Set lft
     *
     * @param integer $lft
     * @return Node
     */
    public function setLft($lft)
    {
        $this->lft = $lft;

        return $this;
    }

    /**
     * Get lft
     *
     * @return integer
     */
    public function getLft()
    {
        return $this->lft;
    }

    /**
     * Set rgt
     *
     * @param integer $rgt
     * @return Node
     */
    public function setRgt($rgt)
    {
        $this->rgt = $rgt;

        return $this;
    }

    /**
     * Get rgt
     *
     * @return integer
     */
    public function getRgt()
    {
        return $this->rgt;
    }

    /**
     * Set lvl
     *
     * @param integer $lvl
     * @return Node
     */
    public function setLvl($lvl)
    {
        $this->lvl = $lvl;

        return $this;
    }

    /**
     * Get lvl
     *
     * @return integer
     */
    public function getLvl()
    {
        return $this->lvl;
    }

    /**
     * Add children
     *
     * @param \Sidus\SidusBundle\Entity\Node $children
     * @return Node
     */
    public function addChildren(\Sidus\SidusBundle\Entity\Node $children)
    {
        $this->children[] = $children;

        return $this;
    }

    /**
     * Remove children
     *
     * @param \Sidus\SidusBundle\Entity\Node $children
     */
    public function removeChildren(\Sidus\SidusBundle\Entity\Node $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Set parentId
     *
     * @param integer $parentId
     * @return Node
     */
    public function setParentId($parentId)
    {
        $this->parentId = $parentId;
    
        return $this;
    }

    /**
     * Get parentId
     *
     * @return integer 
     */
    public function getParentId()
    {
        return $this->parentId;
    }
}