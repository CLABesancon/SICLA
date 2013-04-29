<?php

namespace SICLA\AraBundle\Entity;
use Sidus\SidusBundle\Entity\Object;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logement
 *
 * @ORM\Table(name="ara_logement")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\LogementRepository")
 * 
 */
class Logement extends Object
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
     * @var boolean
     *
     * @ORM\Column(name="meuble", type="boolean")
     */
    private $meuble;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbChambres", type="integer")
     */
    private $nbChambres;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="surface", type="integer")
     */
    private $surface;

    /**
     * @var float
     *
     * @ORM\Column(name="loyer", type="float")
     */
    private $loyer;

    /**
     * @var float
     *
     * @ORM\Column(name="charges", type="float")
     */
    private $charges;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sdbPrivative", type="boolean")
     */
    private $sdbPrivative;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="consommationEnergie", type="integer")
     */
    private $consommationEnergie;
	
	/**
     * @var integer
     *
     * @ORM\Column(name="emissionGes", type="integer")
     */
    private $emissionGes;
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="ascenseur", type="boolean")
     */
	private $ascenseur;
	
	/** 
	 * @ORM\ManyToMany(targetEntity="SICLA\AraBundle\Entity\Equipement")
	 * @ORM\JoinTable(name="ara_logement_equipement")
	 * 
	 */
	private $equipements;
	
    /**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\TypeLogement")
	* @ORM\JoinColumn( nullable=false )
	* 
	*/
	private $typeLogement;
	
	/**
	* @ORM\OneToOne(targetEntity="SICLA\HydraBundle\Entity\Address", cascade={"persist"})
	*/
	private $address;
   
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
     * Set meuble
     *
     * @param boolean $meuble
     * @return Logement
     */
    public function setMeuble($meuble)
    {
        $this->meuble = $meuble;
    
        return $this;
    }

    /**
     * Get meuble
     *
     * @return boolean 
     */
    public function getMeuble()
    {
        return $this->meuble;
    }

    /**
     * Set nbChambres
     *
     * @param integer $nbChambres
     * @return Logement
     */
    public function setNbChambres($nbChambres)
    {
        $this->nbChambres = $nbChambres;
    
        return $this;
    }

    /**
     * Get nbChambres
     *
     * @return integer 
     */
    public function getNbChambres()
    {
        return $this->nbChambres;
    }

    /**
     * Set loyer
     *
     * @param float $loyer
     * @return Logement
     */
    public function setLoyer($loyer)
    {
        $this->loyer = $loyer;
    
        return $this;
    }

    /**
     * Get loyer
     *
     * @return float 
     */
    public function getLoyer()
    {
        return $this->loyer;
    }
	
	/**
     * Set surface
     *
     * @param float $surface
     * @return Logement
     */
    public function setSurface($surface)
    {
        $this->surface = $surface;
    
        return $this;
    }

    /**
     * Get surface
     *
     * @return integer
     */
    public function getSurface()
    {
        return $this->surface;
    }
	
	/**
     * Set consommationEnergie
     *
     * @param integer $consommationEnergie
     * @return Logement
     */
    public function setConsommationEnergie($consommationEnergie)
    {
        $this->consommationEnergie = $consommationEnergie;
    
        return $this;
    }

    /**
     * Get consommationEnergie
     *
     * @return integer 
     */
    public function getConsommationEnergie()
    {
        return $this->consommationEnergie;
    }
	
	/**
     * Set emissionGes
     *
     * @param integer $emissionGes
     * @return Logement
     */
    public function setEmissionGes($emissionGes)
    {
        $this->emissionGes = $emissionGes;
    
        return $this;
    }

    /**
     * Get emissionGes
     *
     * @return integer 
     */
    public function getEmissionGes()
    {
        return $this->emissionGes;
    }

	

    /**
     * Set charges
     *
     * @param float $charges
     * @return Logement
     */
    public function setCharges($charges)
    {
        $this->charges = $charges;
    
        return $this;
    }

    /**
     * Get charges
     *
     * @return float 
     */
    public function getCharges()
    {
        return $this->charges;
    }

    /**
     * Set ascenseur
     *
     * @param boolean $sdbPrivative
     * @return Logement
     */
    public function setAscenseur($ascenseur)
    {
        $this->ascenseur = $ascenseur;
    
        return $this;
    }

    /**
     * Get ascenseur
     *
     * @return boolean 
     */
    public function getAscenseur()
    {
        return $this->ascenseur;
    }
	
	/**
     * Set sdbPrivative
     *
     * @param boolean $sdbPrivative
     * @return Logement
     */
    public function setSdbPrivative($sdbPrivative)
    {
        $this->sdbPrivative = $sdbPrivative;
    
        return $this;
    }

    /**
     * Get sdbPrivative
     *
     * @return boolean 
     */
    public function getSdbPrivative()
    {
        return $this->sdbPrivative;
    }
	
	
	/**
	  * Add equipements
	  *
	  * @param \SICLA\AraBundle\Entity\Equipement $equipement
	  */
	public function addEquipement(\SICLA\AraBundle\Entity\Equipement $equipement) 
	{
	  $this->equipements[] = $equipement;
	}

	/**
	  * Remove equipements
	  *
	  * @param \SICLA\AraBundle\Entity\Equipement $equipements
	  */
	public function removeEquipement(\SICLA\AraBundle\Entity\Equipement $equipement) 
	{
	  $this->equipements->removeElement($equipement);
	}

	/**
	  * Get equipements
	  *
	  * @return Doctrine\Common\Collections\Collection
	  */
	public function getEquipement()
	{
	  return $this->equipements;
	}
	
	
	/**
   * Set typeLogement
   *
   * @param \SICLA\AraBundle\Entity\TypeLogement $typeLogement
   */
  public function setTypeLogement(\SICLA\AraBundle\Entity\TypeLogement $typeLogement)
  {
    $this->typeLogement = $typeLogement;
  }
 
  /**
   * Get typeLogement
   *
   * @return \SICLA\AraBundle\Entity\TypeLogement $typeLogement
   */
  public function getTypeLogement()
  {
    return $this->typeLogement;
  }
 
 
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->equipements = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Get equipements
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEquipements()
    {
        return $this->equipements;
    }

    /**
     * Set address
     *
     * @param \SICLA\HydraBundle\Entity\Address; $address
     * @return Logement
     */
    public function setAddress(\SICLA\HydraBundle\Entity\Address $address = null)
    {
        $this->address = $address;
    
        return $this;
    }

    /**
     * Get address
     *
     * @return \SICLA\HydraBundle\Entity\Address; 
     */
    public function getAddress()
    {
        return $this->address;
    }
}