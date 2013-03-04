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
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({
 * 	"core_page" = "Page",
 * 	"core_user" = "User",
 * 	"core_type" = "Type",
 * 	"core_folder" = "Folder",
 * 	"core_users" = "Folder",
 * 	"core_types" = "Folder"
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

    /** var string
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @ORM\ManyToOne(targetEntity="Sidus\SidusBundle\Entity\Type")
     * @ORM\JoinColumn(nullable=true)
     */
    private $type;

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
     * Set type
     *
     * @param integer $type
     * @return Node
     */
    public function setType($type) {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Object
     */
    public function setTitle($title) {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle() {
        return $this->title;
    }

    public function __toString() {
        return $this->getTitle();
    }

    /**
     * Add versions
     *
     * @param Version $versions
     * @return Object
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

}