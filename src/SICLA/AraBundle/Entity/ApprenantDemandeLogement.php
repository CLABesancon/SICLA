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
     * @var integer
     * @ORM\Column(name="idStagiaire", type="integer", nullable=true)
     */
    private $idStagiaire;
	
	/**
	* @ORM\ManyToMany(targetEntity="SICLA\AraBundle\Entity\GroupeApprenants")
	* @ORM\JoinTable(name="ara_apprenantDemandeLogement_groupe")
	*/
	private $groupeApprenants;
	
	/**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;
	
	/**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;
	
	/**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=true)
     */
    private $mail;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="ddn", type="date", nullable=true)
     */
    private $ddn;
	
	/**
     * @var string
     *
     * @ORM\Column(name="tel", type="string", length=255, nullable=true)
     */
    private $tel;
	
	/**
     * @var string
     *
     * @ORM\Column(name="adresse", type="text", length=255, nullable=true)
     */
    private $adresse;
	
	/**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255, nullable=true)
     */
    private $pays;
	
	 /**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\RegimeAlimentaire")
	* @ORM\JoinColumn(nullable=true)
	*/
    private $regimeAlimentaire;
	
	/**
     * @var boolean
     *
     * @ORM\Column(name="debutantFrancais", type="boolean", nullable=true)
     */
    private $debutantFrancais;
	
	/**
     * @var string
     *
     * @ORM\Column(name="situationMaritale", type="string", length=255, nullable=true)
     */
    private $situationMaritale;

	/**
     * @var \DateTime
     *
     * @ORM\Column(name="debutFormation", type="date", nullable=true)
     */
    private $debutFormation;
	
	/**
     * @var \DateTime
     *
     * @ORM\Column(name="finFormation", type="date", nullable=true)
     */
    private $finFormation;
	
	/**
     * @var string
     *
     * @ORM\Column(name="typeHebergement", type="string", length=255, nullable=true)
     */
    private $typeHebergement;
	
	/**
     * @var string
     *
     * @ORM\Column(name="nomFormation", type="string", length=255, nullable=true)
     */
    private $nomFormation;
	
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
	* @ORM\OneToMany(targetEntity="SICLA\AraBundle\Entity\AffectationDemande", mappedBy="demande")
	*/
	 private $affectations;
	
	 /**
     * @var integer
     * @ORM\Column(name="nbPersonne", type="integer", nullable=true)
     */
    private $nbPersonne;
	
	 /**
     * @var integer
     * @ORM\Column(name="nbLit", type="integer", nullable=true)
     */
    private $nbLit;
	
	 /**
     * @var integer
     * @ORM\Column(name="loyerMax", type="integer", nullable=true)
     */
    private $loyerMax;
	 
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

    /**
     * Set nom
     *
     * @param string $nom
     * @return ApprenantDemandeLogement
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    
        return $this;
    }

    /**
     * Get nom
     *
     * @return string 
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     * @return ApprenantDemandeLogement
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    
        return $this;
    }

    /**
     * Get prenom
     *
     * @return string 
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set pays
     *
     * @param string $pays
     * @return ApprenantDemandeLogement
     */
    public function setPays($pays)
    {
        $this->pays = $pays;
    
        return $this;
    }

    /**
     * Get pays
     *
     * @return string 
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set debutantFrancais
     *
     * @param boolean $debutantFrancais
     * @return ApprenantDemandeLogement
     */
    public function setDebutantFrancais($debutantFrancais)
    {
        $this->debutantFrancais = $debutantFrancais;
    
        return $this;
    }

    /**
     * Get debutantFrancais
     *
     * @return boolean 
     */
    public function getDebutantFrancais()
    {
        return $this->debutantFrancais;
    }

    /**
     * Set situationMaritale
     *
     * @param string $situationMaritale
     * @return ApprenantDemandeLogement
     */
    public function setSituationMaritale($situationMaritale)
    {
        $this->situationMaritale = $situationMaritale;
    
        return $this;
    }

    /**
     * Get situationMaritale
     *
     * @return string 
     */
    public function getSituationMaritale()
    {
        return $this->situationMaritale;
    }

    /**
     * Set debutFormation
     *
     * @param \DateTime $debutFormation
     * @return ApprenantDemandeLogement
     */
    public function setDebutFormation($debutFormation)
    {
        $this->debutFormation = $debutFormation;
    
        return $this;
    }

    /**
     * Get debutFormation
     *
     * @return \DateTime 
     */
    public function getDebutFormation()
    {
        return $this->debutFormation;
    }

    /**
     * Set finFormation
     *
     * @param \DateTime $finFormation
     * @return ApprenantDemandeLogement
     */
    public function setFinFormation($finFormation)
    {
        $this->finFormation = $finFormation;
    
        return $this;
    }

    /**
     * Get finFormation
     *
     * @return \DateTime 
     */
    public function getFinFormation()
    {
        return $this->finFormation;
    }

    /**
     * Set typeHebergement
     *
     * @param string $typeHebergement
     * @return ApprenantDemandeLogement
     */
    public function setTypeHebergement($typeHebergement)
    {
        $this->typeHebergement = $typeHebergement;
    
        return $this;
    }

    /**
     * Get typeHebergement
     *
     * @return string 
     */
    public function getTypeHebergement()
    {
        return $this->typeHebergement;
    }

    /**
     * Set nomFormation
     *
     * @param string $nomFormation
     * @return ApprenantDemandeLogement
     */
    public function setNomFormation($nomFormation)
    {
        $this->nomFormation = $nomFormation;
    
        return $this;
    }

    /**
     * Get nomFormation
     *
     * @return string 
     */
    public function getNomFormation()
    {
        return $this->nomFormation;
    }

    /**
     * Set mail
     *
     * @param string $mail
     * @return ApprenantDemandeLogement
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    
        return $this;
    }

    /**
     * Get mail
     *
     * @return string 
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set ddn
     *
     * @param \DateTime $ddn
     * @return ApprenantDemandeLogement
     */
    public function setDdn($ddn)
    {
        $this->ddn = $ddn;
    
        return $this;
    }

    /**
     * Get ddn
     *
     * @return \DateTime 
     */
    public function getDdn()
    {
        return $this->ddn;
    }

    /**
     * Set tel
     *
     * @param string $tel
     * @return ApprenantDemandeLogement
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    
        return $this;
    }

    /**
     * Get tel
     *
     * @return string 
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     * @return ApprenantDemandeLogement
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;
    
        return $this;
    }

    /**
     * Get adresse
     *
     * @return string 
     */
    public function getAdresse()
    {
        return $this->adresse;
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
     * Set nbPersonne
     *
     * @param integer $nbPersonne
     * @return ApprenantDemandeLogement
     */
    public function setNbPersonne($nbPersonne)
    {
        $this->nbPersonne = $nbPersonne;
    
        return $this;
    }

    /**
     * Get nbPersonne
     *
     * @return integer 
     */
    public function getNbPersonne()
    {
        return $this->nbPersonne;
    }

    /**
     * Set nbLit
     *
     * @param integer $nbLit
     * @return ApprenantDemandeLogement
     */
    public function setNbLit($nbLit)
    {
        $this->nbLit = $nbLit;
    
        return $this;
    }

    /**
     * Get nbLit
     *
     * @return integer 
     */
    public function getNbLit()
    {
        return $this->nbLit;
    }

    /**
     * Set loyerMax
     *
     * @param integer $loyerMax
     * @return ApprenantDemandeLogement
     */
    public function setLoyerMax($loyerMax)
    {
        $this->loyerMax = $loyerMax;
    
        return $this;
    }

    /**
     * Get loyerMax
     *
     * @return integer 
     */
    public function getLoyerMax()
    {
        return $this->loyerMax;
    }

	
}