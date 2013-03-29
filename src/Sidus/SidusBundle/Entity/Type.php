<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table(name="type")
 * @ORM\Entity(repositoryClass="Sidus\SidusBundle\Entity\TypeRepository")
 */
class Type extends Object
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id_object", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="typename", type="string", length=255)
     */
    private $typename;

    /**
     * @var string
     *
     * @ORM\Column(name="controller", type="string", length=255, nullable=true)
     */
    private $controller;

	/**
     * @var Type[]
     * @ORM\ManyToMany(targetEntity="Sidus\SidusBundle\Entity\Type", cascade={"persist"})
	 * @ORM\JoinTable(name="authorized_type",
	 *	joinColumns={@ORM\JoinColumn(name="type_id", referencedColumnName="id")},
	 *	inverseJoinColumns={@ORM\JoinColumn(name="authorized_type_id", referencedColumnName="id")}
	 *	)
     */
	private $authorizedTypes;

	/**
     * @var Type[]
     * @ORM\ManyToMany(targetEntity="Sidus\SidusBundle\Entity\Type", cascade={"persist"})
     * @ORM\JoinTable(name="forbidden_type",
	 *	joinColumns={@ORM\JoinColumn(name="type_id", referencedColumnName="id")},
	 *	inverseJoinColumns={@ORM\JoinColumn(name="forbidden_type_id", referencedColumnName="id")}
	 *	)
     */
	private $forbiddenTypes;


	public function __construct() {
		parent::__construct();
		$this->authorizedTypes = new \Doctrine\Common\Collections\ArrayCollection();
		$this->forbiddenTypes = new \Doctrine\Common\Collections\ArrayCollection();
	}

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set typename
     *
     * @param string $typename
     * @return Type
     */
    public function setTypename($typename)
    {
        $this->typename = $typename;

        return $this;
    }

    /**
     * Get typename
     *
     * @return string
     */
    public function getTypename()
    {
        return $this->typename;
    }

    /**
     * Set controller
     *
     * @param string $controller
     * @return Type
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Get controller
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

	public function addAuthorizedType(Type $type){
		$this->authorizedTypes[] = $type;

        return $this;
	}
	public function removeAuthorizedType(Type $type){
		 $this->authorizedTypes->removeElement($type);
	}
	public function getAuthorizedTypes(){
		return $this->authorizedTypes;
	}

	public function addForbiddenType(Type $type){
		$this->forbiddenTypes[] = $type;

        return $this;
	}
	public function removeForbiddenType(Type $type){
		 $this->forbiddenTypes->removeElement($type);
	}
	public function getForbiddenTypes(){
		return $this->forbiddenTypes;
	}

}