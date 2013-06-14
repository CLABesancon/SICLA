<?php

namespace SICLA\AraBundle\Entity;
use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * FamilleAccueil
 *
 * @ORM\Table(name="ara_famille_accueil")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\FamilleAccueilRepository")
 */
class FamilleAccueil extends Object
{
	/**
     * @var string
     *
     * @ORM\Column(name="typeAccueil", type="string", length=255, nullable=true)
     */
    private $typeAccueil;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="debutDispo", type="date", nullable=true)
     */
    private $debutDispo;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="finDispo", type="date", nullable=true)
     */
    private $finDispo;
	
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="fumeur", type="boolean")
     */
    private $fumeur;

    /**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\RegimeAlimentaire")
	* @ORM\JoinColumn(nullable=true)
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
     * @ORM\Column(name="nbEnfants", type="integer", nullable=true)
     */
    private $nbEnfants;
	
	/**
	* @ORM\ManyToMany(targetEntity="SICLA\AraBundle\Entity\Loisir")
	* @ORM\JoinTable(name="ara_familleAccueil_loisir")
	*/
	private $loisirs;
	
	/**
	* @ORM\ManyToMany(targetEntity="SICLA\AraBundle\Entity\TypeAnimal")
	* @ORM\JoinTable(name="ara_familleAccueil_animaux")
	*/
	private $animaux;
	
	/**
	 * 
     * @var integer
     *
     * @ORM\Column(name="nbLit", type="integer", nullable=true)
     */
    private $nbLit;
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="ascenseur", type="boolean")
     */
	private $ascenseur;
	
	/**
     * @var string
     *
     * @ORM\Column(name="souhaitNationalite", type="string", length=255)
     */
    private $souhaitNationalite;
	
	/**
     * @var string
     *
     * @ORM\Column(name="souhaitSexe", type="string", length=255)
     */
    private $souhaitSexe;
	
	/**
     * @var string
     *
     * @ORM\Column(name="souhaitPublic", type="string", length=255)
     */
    private $souhaitPublic;
	
	 /**
     * @var boolean
     *
     * @ORM\Column(name="sdbPrivative", type="boolean")
     */
    private $sdbPrivative;
	
	 /**
     * @var boolean
     *
     * @ORM\Column(name="accesCuisine", type="boolean")
     */
    private $accesCuisine;
	
	/**
     * @var string
     *
     * @ORM\Column(name="conditionsAccesCuisine", type="text", nullable=true)
     */
    private $conditionsAccesCuisine;
	
	/**
     * @var string
     *
     * @ORM\Column(name="remarquesParticulieres", type="text", nullable=true)
     */
    private $remarquesParticulieres;
	
	/**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\TypeLogement")
	* @ORM\JoinColumn( nullable=true )
	* 
	*/
	private $typeLogement;
	
	/**
     * @var string
     *
     * @ORM\Column(name="ligneBus", type="string", length=255, nullable=true)
     */
    private $ligneBus;
	
	/**
     * @var string
     *
     * @ORM\Column(name="arretBus", type="string", length=255, nullable=true)
     */
    private $arretBus;
	
	 /**
     * @var float
     *
     * @ORM\Column(name="loyer", type="float", nullable=true)
     */
    private $loyer;
	
	/**
     * @var float
     *
     * @ORM\Column(name="charges", type="float", nullable=true)
     */
    private $charges;
	
	/**
     * @var string
     *
     * @ORM\Column(name="remarquesServiceLogement", type="text", nullable=false)
     */
    private $remarquesServiceLogement;
	
	/**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\StatutFamille")
	* @ORM\JoinColumn( nullable=true)
	* 
	*/
	private $statut;
	
	/**
	* @ORM\OneToMany(targetEntity="SICLA\AraBundle\Entity\AffectationDemande", mappedBy="famille")
	*/
	 private $affectationsDemandes;
	 
	 /**
	* @ORM\OneToMany(targetEntity="SICLA\AraBundle\Entity\AffectationGroupe", mappedBy="famille")
	*/
	 private $affectationsGroupes;
	
	 /* Set TypeAccueil
	 * 
     * @param string $typeAccueil
     * @return FamilleAccueil
     */
    public function setTypeAccueil($typeAccueil)
    {
        $this->typeAccueil = $typeAccueil;
    
        return $this;
    }

    /**
     * Get TypeAccueil
     *
     * @return string 
     */
    public function getTypeAccueil()
    {
        return $this->typeAccueil;
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
   * Set regimeAlimentaire
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
    

    /**
     * Set debutDispo
     *
     * @param \DateTime $debutDispo
     * @return FamilleAccueil
     */
    public function setDebutDispo($debutDispo)
    {
        $this->debutDispo = $debutDispo;
    
        return $this;
    }

    /**
     * Get debutDispo
     *
     * @return \DateTime 
     */
    public function getDebutDispo()
    {
        return $this->debutDispo;
    }

    /**
     * Set finDispo
     *
     * @param \DateTime $finDispo
     * @return FamilleAccueil
     */
    public function setFinDispo($finDispo)
    {
        $this->finDispo = $finDispo;
    
        return $this;
    }

    /**
     * Get finDispo
     *
     * @return \DateTime 
     */
    public function getFinDispo()
    {
        return $this->finDispo;
    }

    /**
     * Set souhaitNationalite
     *
     * @param string $souhaitNationalite
     * @return FamilleAccueil
     */
    public function setSouhaitNationalite($souhaitNationalite)
    {
        $this->souhaitNationalite = $souhaitNationalite;
    
        return $this;
    }

    /**
     * Get souhaitNationalite
     *
     * @return string 
     */
    public function getSouhaitNationalite()
    {
        return $this->souhaitNationalite;
    }

    /**
     * Set souhaitSexe
     *
     * @param string $souhaitSexe
     * @return FamilleAccueil
     */
    public function setSouhaitSexe($souhaitSexe)
    {
        $this->souhaitSexe = $souhaitSexe;
    
        return $this;
    }

    /**
     * Get souhaitSexe
     *
     * @return string 
     */
    public function getSouhaitSexe()
    {
        return $this->souhaitSexe;
    }

    /**
     * Set souhaitPublic
     *
     * @param string $souhaitPublic
     * @return FamilleAccueil
     */
    public function setSouhaitPublic($souhaitPublic)
    {
        $this->souhaitPublic = $souhaitPublic;
    
        return $this;
    }

    /**
     * Get souhaitPublic
     *
     * @return string 
     */
    public function getSouhaitPublic()
    {
        return $this->souhaitPublic;
    }

    /**
     * Set sdbPrivative
     *
     * @param boolean $sdbPrivative
     * @return FamilleAccueil
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
     * Set accesCuisine
     *
     * @param boolean $accesCuisine
     * @return FamilleAccueil
     */
    public function setAccesCuisine($accesCuisine)
    {
        $this->accesCuisine = $accesCuisine;
    
        return $this;
    }

    /**
     * Get accesCuisine
     *
     * @return boolean 
     */
    public function getAccesCuisine()
    {
        return $this->accesCuisine;
    }

    /**
     * Set conditionsAccesCuisine
     *
     * @param string $conditionsAccesCuisine
     * @return FamilleAccueil
     */
    public function setConditionsAccesCuisine($conditionsAccesCuisine)
    {
        $this->conditionsAccesCuisine = $conditionsAccesCuisine;
    
        return $this;
    }

    /**
     * Get conditionsAccesCuisine
     *
     * @return string 
     */
    public function getConditionsAccesCuisine()
    {
        return $this->conditionsAccesCuisine;
    }

    /**
     * Set remarquesParticulieres
     *
     * @param string $remarquesParticulieres
     * @return FamilleAccueil
     */
    public function setRemarquesParticulieres($remarquesParticulieres)
    {
        $this->remarquesParticulieres = $remarquesParticulieres;
    
        return $this;
    }

    /**
     * Get remarquesParticulieres
     *
     * @return string 
     */
    public function getRemarquesParticulieres()
    {
        return $this->remarquesParticulieres;
    }

    /**
     * Set ligneBus
     *
     * @param string $ligneBus
     * @return FamilleAccueil
     */
    public function setLigneBus($ligneBus)
    {
        $this->ligneBus = $ligneBus;
    
        return $this;
    }

    /**
     * Get ligneBus
     *
     * @return string 
     */
    public function getLigneBus()
    {
        return $this->ligneBus;
    }

    /**
     * Set arretBus
     *
     * @param string $arretBus
     * @return FamilleAccueil
     */
    public function setArretBus($arretBus)
    {
        $this->arretBus = $arretBus;
    
        return $this;
    }

    /**
     * Get arretBus
     *
     * @return string 
     */
    public function getArretBus()
    {
        return $this->arretBus;
    }

    /**
     * Set remarquesServiceLogement
     *
     * @param string $remarquesServiceLogement
     * @return FamilleAccueil
     */
    public function setRemarquesServiceLogement($remarquesServiceLogement)
    {
        $this->remarquesServiceLogement = $remarquesServiceLogement;
    
        return $this;
    }

    /**
     * Get remarquesServiceLogement
     *
     * @return string 
     */
    public function getRemarquesServiceLogement()
    {
        return $this->remarquesServiceLogement;
    }

	    /**
     * Set typeLogement
     *
     * @param \SICLA\AraBundle\Entity\TypeLogement $typeLogement
     * @return FamilleAccueil
     */
    public function setTypeLogement(\SICLA\AraBundle\Entity\TypeLogement $typeLogement)
    {
        $this->typeLogement = $typeLogement;
    
        return $this;
    }

    /**
     * Get typeLogement
     *
     * @return \SICLA\AraBundle\Entity\TypeLogement 
     */
    public function getTypeLogement()
    {
        return $this->typeLogement;
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
     * Set statut
     *
     * @param \SICLA\AraBundle\Entity\StatutFamille $statut
     * @return FamilleAccueil
     */
    public function setStatut(\SICLA\AraBundle\Entity\StatutFamille $statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return \SICLA\AraBundle\Entity\StatutFamille
     */
    public function getStatut()
    {
        return $this->statut;
    }
    
    /**
     * Add animaux
     *
     * @param \SICLA\AraBundle\Entity\TypeAnimal $animaux
     * @return FamilleAccueil
     */
    public function addAnimaux(\SICLA\AraBundle\Entity\TypeAnimal $animaux)
    {
        $this->animaux[] = $animaux;
    
        return $this;
    }

    /**
     * Remove animaux
     *
     * @param \SICLA\AraBundle\Entity\TypeAnimal $animaux
     */
    public function removeAnimaux(\SICLA\AraBundle\Entity\TypeAnimal $animaux)
    {
        $this->animaux->removeElement($animaux);
    }

    /**
     * Get animaux
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAnimaux()
    {
        return $this->animaux;
    }

    /**
     * Add affectationDemande
     *
     * @param \SICLA\AraBundle\Entity\AffectationDemande $affectations
     * @return FamilleAccueil
     */
    public function addAffectationDemande(\SICLA\AraBundle\Entity\AffectationDemande $affectation)
    {
        $this->affectationsDemandes[] = $affectation;
		$affectation->setFamille($this);
        return $this;
    }

    /**
     * Remove affectationDemande
     *
     * @param \SICLA\AraBundle\Entity\AffectationDemande $affectation
     */
    public function removeAffectationDemande(\SICLA\AraBundle\Entity\AffectationDemande $affectation)
    {
        $this->affectationsDemandes->removeElement($affectation);
		$affectation->setFamille(null);
    }

    /**
     * Get affectationsDemandes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffectationsDemandes()
    {
        return $this->affectationsDemandes;
    }

    /**
     * Add affectationGroupe
     *
     * @param \SICLA\AraBundle\Entity\AffectationGroupe $affectationsGroupe
     * @return FamilleAccueil
     */
    public function addAffectationGroupe(\SICLA\AraBundle\Entity\AffectationGroupe $affectationGroupe)
    {
        $this->affectationsGroupes[] = $affectationGroupe;
		$affectationGroupe->setFamille($this);
        return $this;
    }

    /**
     * Remove affectationGroupe
     *
     * @param \SICLA\AraBundle\Entity\AffectationGroupe $affectationsGroupes
     */
    public function removeAffectationsGroupe(\SICLA\AraBundle\Entity\AffectationGroupe $affectationGroupe)
    {
        $this->affectationsGroupes->removeElement($affectationGroupe);
		$affectationGroupe->setFamille(null);
    }

    /**
     * Get affectationsGroupes
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffectationsGroupes()
    {
        return $this->affectationsGroupes;
    }

}