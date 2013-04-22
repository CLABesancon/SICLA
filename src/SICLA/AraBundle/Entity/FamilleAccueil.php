<?php

namespace SICLA\AraBundle\Entity;
use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * FamilleAccueil
 *
 * @ORM\Table(name="ara_familleAccueil")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\FamilleAccueilRepository")
 */
class FamilleAccueil extends Object
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
     * @ORM\Column(name="dureeSejour", type="string", length=255)
     */
    private $dureeSejour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fumeur", type="boolean")
     */
    private $fumeur;

    /**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\RegimeAlimentaire")
	* @ORM\JoinColumn(nullable=false)
	*/
    private $regimeAlimentaire;

    /**
     * @var boolean
     *
     * @ORM\Column(name="adaptableRegimeAlimentaire", type="boolean")
     */
    private $adaptableRegimeAlimentaire;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbEnfants", type="integer")
     */
    private $nbEnfants;
	
	/**
	* @ORM\ManyToMany(targetEntity="SICLA\AraBundle\Entity\Loisir")
	* @ORM\JoinTable(name="ara_familleAccueil_loisir")
	*/
	private $loisirs;

	/**
	* @ORM\ManyToMany(targetEntity="SICLA\AraBundle\Entity\TypeAnimal")
	 * @ORM\JoinTable(name="ara_familleAccueil_typeAnimal")
	*/
	private $animaux;
	
	/**
	 * 
     * @var integer
     *
     * @ORM\Column(name="nbLit", type="integer")
     */
    private $nbLit;
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="ascenseur", type="boolean")
     */
	private $ascenseur;
	
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
     * Set dureeSejour
     *
     * @param string $dureeSejour
     * @return FamilleAccueil
     */
    public function setDureeSejour($dureeSejour)
    {
        $this->dureeSejour = $dureeSejour;
    
        return $this;
    }

    /**
     * Get dureeSejour
     *
     * @return string 
     */
    public function getDureeSejour()
    {
        return $this->dureeSejour;
    }

    /**
     * Set fumeur
     *
     * @param boolean $fumeur
     * @return FamilleAccueil
     */
    public function setFumeur($fumeur)
    {
        $this->fumeur = $fumeur;
    
        return $this;
    }

    /**
     * Get fumeur
     *
     * @return boolean 
     */
    public function getFumeur()
    {
        return $this->fumeur;
    }

    /**
   * Set typeLogement
   *
   * @param \SICLA\AraBundle\Entity\RegimeALimentaire $regimeAlimentaire
   */
	
    public function setRegimeAlimentaire($regimeAlimentaire)
    {
        $this->regimeAlimentaire = $regimeAlimentaire;
    }

    /**
     * Get regimeAlimentaire
     *
     * @return \SICLA\AraBundle\Entity\RegimeALimentaire $regimeAlimentaire
     */
    public function getRegimeAlimentaire()
    {
        return $this->regimeAlimentaire;
    }

    /**
     * Set adaptableRegimeAlimentaire
     *
     * @param boolean $adaptableRegimeAlimentaire
     * @return FamilleAccueil
     */
    public function setAdaptableRegimeAlimentaire($adaptableRegimeAlimentaire)
    {
        $this->adaptableRegimeAlimentaire = $adaptableRegimeAlimentaire;
    
        return $this;
    }

    /**
     * Get adaptableRegimeAlimentaire
     *
     * @return boolean 
     */
    public function getAdaptableRegimeAlimentaire()
    {
        return $this->adaptableRegimeAlimentaire;
    }

    /**
     * Set nbEnfants
     *
     * @param integer $nbEnfants
     * @return FamilleAccueil
     */
    public function setNbEnfants($nbEnfants)
    {
        $this->nbEnfants = $nbEnfants;
    
        return $this;
    }

    /**
     * Get nbEnfants
     *
     * @return integer 
     */
    public function getNbEnfants()
    {
        return $this->nbEnfants;
    }
	
	
  /**
		* Add loisirs
		*
		* @param \SICLA\AraBundle\Entity\Loisir $loisir
		*/
	public function addLoisir(\SICLA\AraBundle\Entity\Loisir $loisir) 
	{
	  $this->loisirs[] = $loisir;
	}

	/**
	  * Remove loisirs
	  *
	  * @param \SICLA\AraBundle\Entity\Loisir $loisir
	  */
	public function removeLoisir(\SICLA\AraBundle\Entity\Loisir $loisir) 
	{
	  $this->loisirs->removeElement($loisir);
	}

	/**
	  * Get loisirs
	  *
	  * @return Doctrine\Common\Collections\Collection
	  */
	public function getLoisirs()
	{
	  return $this->loisirs;
	}
  
   /**
		* Add Animaux
		*
		* @param \SICLA\AraBundle\Entity\TypeAnimal $animal
		*/
	public function addAnimaux(\SICLA\AraBundle\Entity\TypeAnimal $animal) 
	{
	  $this->animaux[] = $animal;
	}

  /**
    * Remove animaux
    *
    * @param SICLA\AraBundle\Entity\TypeAnimal $animal
    */
  public function removeAnimaux(SICLA\AraBundle\Entity\TypeAnimal $animal)
  {
   
    $this->animaux->removeElement($animal);
  }
 
  /**
    * Get animaux
    *
    * @return Doctrine\Common\Collections\Collection
    */
  public function getAnimaux() 
  {
    return $this->animaux;
  }
  
  /**
     * Set nbLit
     *
     * @param integer $nbLit
     * @return FamilleAccueil
     */
    public function setNbLit($nbLit)
    {
        $this->nbLit = $nbLit;
    
        return $this;
    }

    /**
     * Get nbEnfants
     *
     * @return integer 
     */
    public function getNbLit()
    {
        return $this->nbLit;
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
     * Constructor
     */
    public function __construct()
    {
        $this->loisirs = new \Doctrine\Common\Collections\ArrayCollection();
        $this->animaux = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
}