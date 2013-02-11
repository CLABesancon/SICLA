<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Type
 *
 * @ORM\Table()
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
     * @ORM\Column(name="classname", type="string", length=255, nullable=true)
     */
    private $classname;


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
     * Set classname
     *
     * @param string $classname
     * @return Type
     */
    public function setClassname($classname)
    {
        $this->classname = $classname;
    
        return $this;
    }

    /**
     * Get classname
     *
     * @return string 
     */
    public function getClassname()
    {
        return $this->classname;
    }
	
	public function getControllerPath(){

		$path = '';
		if(!$this->classname){
			//@TODO : récupérer le controller du parent
		}else{
			$array = explode('\\',$this->classname);
			$path = $array[count($array)-3].':'.$array[count($array)-1];
		}
		return $path;
		
	}
}
