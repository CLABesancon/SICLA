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
 *	"core_page" = "Page",
 *	"core_user" = "User",
 *	"core_type" = "Type",
 *	"core_folder" = "Folder",
 *	"core_users" = "Folder",
 *	"core_types" = "Folder"
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
    public function setTitle($title)
    {
        $this->title = $title;
    
        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }
	
	public function __toString() {
		return $this->getTitle();
	}
	
	public function getControllerPath(){
		/* @TODO : controller path via l'objet (a mettre dans le repo)
		 * Le controller path doit dépendre du type de l'objet, et prendre en compte l'arborescence des types
		 * Si le type de l'objet n'a pas de controller défini, on prend celui du parent, récursivement
		 * Si on en trouve finalement pas, on prend le controller par défaut (page? folder? autre?)
		 */
		
		
		$path_class = get_class($this); //--> retourne bien la classe de l'objet! (ex : Sidus\SidusBundle\Entity\Page)
		$array = explode('\\',$path_class);
		
		$class= $array[count($array)-1];
		$bundle = $array[count($array)-3];
		
		return $bundle.':'.$class;
		
	}
}