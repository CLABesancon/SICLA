<?php

namespace SICLA\AraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TypeLogement
 *
 * @ORM\Table(name="ara_typeLogement")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\TypeLogementRepository")
 */
class TypeLogement
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
	 */	
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;


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
     * Set libelle
     *
     * @param string $libelle
     * @return TypeLogement
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
	
	public function __construct()
    {
        $this->libelle ="";
    }
}