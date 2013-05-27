<?php

namespace SICLA\AraBundle\Entity;
use Sidus\SidusBundle\Entity\Object;


use Doctrine\ORM\Mapping as ORM;

/**
 * ApprenantDemandeLogement
 *
 * @ORM\Table(name="ara_apprenantDemandeLogement")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\ApprenantDemandeLogementRepository")
 */
class ApprenantDemandeLogement extends Object
{

    /**
     * @var boolean
     *
     * @ORM\Column(name="handicapPhysique", type="boolean")
     */
    private $handicapPhysique;

    /**
     * @var string
     *
     * @ORM\Column(name="detailHandicap", type="text", nullable=true)
     */
    private $detailHandicap;

    /**
     * @var boolean
     *
     * @ORM\Column(name="traitementMedical", type="boolean")
     */
    private $traitementMedical;

    /**
     * @var string
     *
     * @ORM\Column(name="detailTraitement", type="text", nullable=true)
     */
    private $detailTraitement;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allergiesAnimaux", type="boolean")
     */
    private $allergiesAnimaux;

    /**
     * @var string
     *
     * @ORM\Column(name="detailAllergiesAnimaux", type="text", nullable=true)
     */
    private $detailAllergiesAnimaux;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allergiesAlimentaires", type="boolean")
     */
    private $allergiesAlimentaires;

    /**
     * @var string
     *
     * @ORM\Column(name="detailAllergiesAlimentaires", type="text" , nullable=true)
     */
    private $detailAllergiesAlimentaires;

    /**
     * @var boolean
     *
     * @ORM\Column(name="allergiesAutres", type="boolean")
     */
    private $allergiesAutres;

    /**
     * @var string
     *
     * @ORM\Column(name="detailAllergiesAutres", type="text", nullable=true)
     */
    private $detailAllergiesAutres;

    /**
     * @var boolean
     *
     * @ORM\Column(name="fumeur", type="boolean")
     */
    private $fumeur;

    /**
     * @var boolean
     *
     * @ORM\Column(name="tolerantFumee", type="boolean")
     */
    private $tolerantFumee;

    /**
     * @var boolean
     *
     * @ORM\Column(name="vehicule", type="boolean")
     */
    private $vehicule;

    /**
     * @var boolean
     *
     * @ORM\Column(name="voeuxPersonnels", type="boolean")
     */
    private $voeuxPersonnels;

    /**
     * @var string
     *
     * @ORM\Column(name="detailVoeuxPersonnels", type="text", nullable=true)
     */
    private $detailVoeuxPersonnels;

    /**
     * @var boolean
     *
     * @ORM\Column(name="loisirsParticuliers", type="boolean")
     */
    private $loisirsParticuliers;
	
	/**
     * @var string
     *
     * @ORM\Column(name="detailLoisirsParticuliers", type="text", nullable=true)
     */
    private $detailLoisirsParticuliers;
	
	/**
	* @ORM\ManyToMany(targetEntity="SICLA\AraBundle\Entity\Loisir")
	* @ORM\JoinTable(name="ara_apprenantDemandeLogement_loisir")
	*/
	private $loisirs;
	
	/**
	* @ORM\ManyToMany(targetEntity="SICLA\AraBundle\Entity\GroupeApprenants")
	* @ORM\JoinTable(name="ara_apprenantDemandeLogement_groupe")
	*/
	private $groupeApprenants;
	
	/**
     * @var integer
     * @ORM\Column(name="idStagiaire", type="integer", nullable=true)
     */
    private $idStagiaire;
	
	/**
	* @ORM\OneToMany(targetEntity="SICLA\AraBundle\Entity\AffectationDemande", mappedBy="demande")
	*/
	 private $affectations;
	
    /**
     * Set handicapPhysique
     *
     * @param boolean $handicapPhysique
     * @return ApprenantDemandeLogement
     */
    public function setHandicapPhysique($handicapPhysique)
    {
        $this->handicapPhysique = $handicapPhysique;
    
        return $this;
    }

    /**
     * Get handicapPhysique
     *
     * @return boolean 
     */
    public function getHandicapPhysique()
    {
        return $this->handicapPhysique;
    }

    /**
     * Set detailHandicap
     *
     * @param string $detailHandicap
     * @return ApprenantDemandeLogement
     */
    public function setDetailHandicap($detailHandicap)
    {
        $this->detailHandicap = $detailHandicap;
    
        return $this;
    }

    /**
     * Get detailHandicap
     *
     * @return string 
     */
    public function getDetailHandicap()
    {
        return $this->detailHandicap;
    }

    /**
     * Set traitementMedical
     *
     * @param boolean $traitementMedical
     * @return ApprenantDemandeLogement
     */
    public function setTraitementMedical($traitementMedical)
    {
        $this->traitementMedical = $traitementMedical;
    
        return $this;
    }

    /**
     * Get traitementMedical
     *
     * @return boolean 
     */
    public function getTraitementMedical()
    {
        return $this->traitementMedical;
    }

    /**
     * Set detailTraitement
     *
     * @param string $detailTraitement
     * @return ApprenantDemandeLogement
     */
    public function setDetailTraitement($detailTraitement)
    {
        $this->detailTraitement = $detailTraitement;
    
        return $this;
    }

    /**
     * Get detailTraitement
     *
     * @return string 
     */
    public function getDetailTraitement()
    {
        return $this->detailTraitement;
    }

    /**
     * Set allergiesAnimaux
     *
     * @param boolean $allergiesAnimaux
     * @return ApprenantDemandeLogement
     */
    public function setAllergiesAnimaux($allergiesAnimaux)
    {
        $this->allergiesAnimaux = $allergiesAnimaux;
    
        return $this;
    }

    /**
     * Get allergiesAnimaux
     *
     * @return boolean 
     */
    public function getAllergiesAnimaux()
    {
        return $this->allergiesAnimaux;
    }

    /**
     * Set detailAllergiesAnimaux
     *
     * @param string $detailAllergiesAnimaux
     * @return ApprenantDemandeLogement
     */
    public function setDetailAllergiesAnimaux($detailAllergiesAnimaux)
    {
        $this->detailAllergiesAnimaux = $detailAllergiesAnimaux;
    
        return $this;
    }

    /**
     * Get detailAllergiesAnimaux
     *
     * @return string 
     */
    public function getDetailAllergiesAnimaux()
    {
        return $this->detailAllergiesAnimaux;
    }

    /**
     * Set allergiesAlimentaires
     *
     * @param boolean $allergiesAlimentaires
     * @return ApprenantDemandeLogement
     */
    public function setAllergiesAlimentaires($allergiesAlimentaires)
    {
        $this->allergiesAlimentaires = $allergiesAlimentaires;
    
        return $this;
    }

    /**
     * Get allergiesAlimentaires
     *
     * @return boolean 
     */
    public function getAllergiesAlimentaires()
    {
        return $this->allergiesAlimentaires;
    }

    /**
     * Set detailAllergiesAlimentaires
     *
     * @param string $detailAllergiesAlimentaires
     * @return ApprenantDemandeLogement
     */
    public function setDetailAllergiesAlimentaires($detailAllergiesAlimentaires)
    {
        $this->detailAllergiesAlimentaires = $detailAllergiesAlimentaires;
    
        return $this;
    }

    /**
     * Get detailAllergiesAlimentaires
     *
     * @return string 
     */
    public function getDetailAllergiesAlimentaires()
    {
        return $this->detailAllergiesAlimentaires;
    }

    /**
     * Set allergiesAutres
     *
     * @param string $allergiesAutres
     * @return ApprenantDemandeLogement
     */
    public function setAllergiesAutres($allergiesAutres)
    {
        $this->allergiesAutres = $allergiesAutres;
    
        return $this;
    }

    /**
     * Get allergiesAutres
     *
     * @return string 
     */
    public function getAllergiesAutres()
    {
        return $this->allergiesAutres;
    }

    /**
     * Set detailAllergiesAutres
     *
     * @param string $detailAllergiesAutres
     * @return ApprenantDemandeLogement
     */
    public function setDetailAllergiesAutres($detailAllergiesAutres)
    {
        $this->detailAllergiesAutres = $detailAllergiesAutres;
    
        return $this;
    }

    /**
     * Get detailAllergiesAutres
     *
     * @return string 
     */
    public function getDetailAllergiesAutres()
    {
        return $this->detailAllergiesAutres;
    }

    /**
     * Set fumeur
     *
     * @param boolean $fumeur
     * @return ApprenantDemandeLogement
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
     * Set tolerantFumee
     *
     * @param boolean $tolerantFumee
     * @return ApprenantDemandeLogement
     */
    public function setTolerantFumee($tolerantFumee)
    {
        $this->tolerantFumee = $tolerantFumee;
    
        return $this;
    }

    /**
     * Get tolerantFumee
     *
     * @return boolean 
     */
    public function getTolerantFumee()
    {
        return $this->tolerantFumee;
    }

    /**
     * Set vehicule
     *
     * @param boolean $vehicule
     * @return ApprenantDemandeLogement
     */
    public function setVehicule($vehicule)
    {
        $this->vehicule = $vehicule;
    
        return $this;
    }

    /**
     * Get vehicule
     *
     * @return boolean 
     */
    public function getVehicule()
    {
        return $this->vehicule;
    }

    /**
     * Set voeuxPersonnels
     *
     * @param boolean $voeuxPersonnels
     * @return ApprenantDemandeLogement
     */
    public function setVoeuxPersonnels($voeuxPersonnels)
    {
        $this->voeuxPersonnels = $voeuxPersonnels;
    
        return $this;
    }

    /**
     * Get voeuxPersonnels
     *
     * @return boolean 
     */
    public function getVoeuxPersonnels()
    {
        return $this->voeuxPersonnels;
    }
	
	/**
     * Set detailVoeuxPersonnels
     *
     * @param string $detailVoeuxPersonnels
     * @return ApprenantDemandeLogement
     */
    public function setDetailVoeuxPersonnels($detailVoeuxPersonnels)
    {
        $this->detailVoeuxPersonnels = $detailVoeuxPersonnels;
    
        return $this;
    }

    /**
     * Get detailVoeuxPersonnels
     *
     * @return string 
     */
    public function getDetailVoeuxPersonnels()
    {
        return $this->detailVoeuxPersonnels;
    }

    /**
     * Set loisirsParticuliers
     *
     * @param boolean $loisirsParticuliers
     * @return ApprenantDemandeLogement
     */
    public function setLoisirsParticuliers($loisirsParticuliers)
    {
        $this->loisirsParticuliers = $loisirsParticuliers;
    
        return $this;
    }

    /**
     * Get loisirsParticuliers
     *
     * @return boolean 
     */
    public function getLoisirsParticuliers()
    {
        return $this->loisirsParticuliers;
    }
	
	/**
     * Set detailLoisirsParticuliers
     *
     * @param string $detailLoisirsParticuliers
     * @return ApprenantDemandeLogement
     */
    public function setDetailLoisirsParticuliers($detailLoisirsParticuliers)
    {
        $this->detailLoisirsParticuliers = $detailLoisirsParticuliers;
    
        return $this;
    }

    /**
     * Get detailLoisirsParticuliers
     *
     * @return string 
     */
    public function getDetailLoisirsParticuliers()
    {
        return $this->detailLoisirsParticuliers;
    }

	
	/**
	  * Add loisirs
	  *
	  * @param \SICLA\AraBundle\Entity\Loisir $loisirs
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
     * Constructor
     */
    public function __construct()
    {
        $this->loisirs = new \Doctrine\Common\Collections\ArrayCollection();
    }
    

    /**
     * Set idStagiaire
     *
     * @param integer $idStagiaire
     * @return ApprenantDemandeLogement
     */
    public function setIdStagiaire($idStagiaire)
    {
        $this->idStagiaire = $idStagiaire;
    
        return $this;
    }

    /**
     * Get idStagiaire
     *
     * @return integer 
     */
    public function getIdStagiaire()
    {
        return $this->idStagiaire;
    }

    /**
     * Add groupeApprenants
     *
     * @param \SICLA\AraBundle\Entity\GroupeApprenants $groupeApprenants
     * @return ApprenantDemandeLogement
     */
    public function addGroupeApprenant(\SICLA\AraBundle\Entity\GroupeApprenants $groupeApprenants)
    {
        $this->groupeApprenants[] = $groupeApprenants;
    
        return $this;
    }

    /**
     * Remove groupeApprenants
     *
     * @param \SICLA\AraBundle\Entity\GroupeApprenants $groupeApprenants
     */
    public function removeGroupeApprenant(\SICLA\AraBundle\Entity\GroupeApprenants $groupeApprenants)
    {
        $this->groupeApprenants->removeElement($groupeApprenants);
    }

    /**
     * Get groupeApprenants
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGroupeApprenants()
    {
        return $this->groupeApprenants;
    }
    /**
     * Add affectations
     *
     * @param \SICLA\AraBundle\Entity\AffectationDemande $affectations
     * @return ApprenantDemandeLogement
     */
    public function addAffectation(\SICLA\AraBundle\Entity\AffectationDemande $affectations)
    {
        $this->affectations[] = $affectations;
		$affectations->setDemande($this);
    
        return $this;
    }

    /**
     * Remove affectations
     *
     * @param \SICLA\AraBundle\Entity\AffectationDemande $affectation
     */
    public function removeAffectation(\SICLA\AraBundle\Entity\AffectationDemande $affectation)
    {
        $this->affectations->removeElement($affectation);
		$affectation->setDemande(null);
    }

    /**
     * Get affectations
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAffectations()
    {
        return $this->affectations;
    }

}