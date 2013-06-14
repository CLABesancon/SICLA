<?php

namespace SICLA\AraBundle\Entity;

use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * AffectationGroupe
 *
 * @ORM\Table(name="ara_affectation_groupe")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\AffectationGroupeRepository")
 */
class AffectationGroupe extends Object
{
  /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateArrivee", type="date", nullable=true)
     */
    private $dateArrivee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDepart", type="date", nullable=true)
     */
    private $dateDepart;
	
	/**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\FamilleAccueil", inversedBy="affectationsGroupes")
	* @ORM\JoinColumn(nullable=true)
	*/
   private $famille;
   
    /**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\StatutFamille", inversedBy="affectationsGroupes")
	* @ORM\JoinColumn(nullable=true)
	*/
   private $statutFamille;
   
	/**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\GroupeApprenants", inversedBy="affectationsGroupes")
	* @ORM\JoinColumn(nullable=true)
	*/
   private $groupeApprenants;
   
  

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
     * Set dateArrivee
     *
     * @param \DateTime $dateArrivee
     * @return AffectationDemande
     */
    public function setDateArrivee($dateArrivee)
    {
        $this->dateArrivee = $dateArrivee;
    
        return $this;
    }

    /**
     * Get dateArrivee
     *
     * @return \DateTime 
     */
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     * @return AffectationDemande
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;
    
        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime 
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }


    /**
     * Set famille
     *
     * @param \SICLA\AraBundle\Entity\FamilleAccueil $famille
     * @return AffectationGroupe
     */
    public function setFamille(\SICLA\AraBundle\Entity\FamilleAccueil $famille = null)
    {
        $this->famille = $famille;
        return $this;
    }

    /**
     * Get famille
     *
     * @return \SICLA\AraBundle\Entity\FamilleAccueil 
     */
    public function getFamille()
    {
        return $this->famille;
    }

     /**
     * Set statutFamille
     *
     * @param \SICLA\AraBundle\Entity\StatutFamille $statutFamille
     * @return AffectationDemande
     */
    public function setStatutFamille(\SICLA\AraBundle\Entity\StatutFamille $statutFamille = null)
    {
        $this->statutFamille = $statutFamille;
    
        return $this;
    }

    /**
     * Get statutFamille
     *
     * @return \SICLA\AraBundle\Entity\StatutFamille 
     */
    public function getStatutFamille()
    {
        return $this->statutFamille;
    }
	
    /**
     * Set groupeApprenants
     *
     * @param \SICLA\AraBundle\Entity\GroupeApprenants $groupeApprenants
     * @return AffectationGroupe
     */
    public function setGroupeApprenants(\SICLA\AraBundle\Entity\GroupeApprenants $groupeApprenants = null)
    {
        $this->groupeApprenants = $groupeApprenants;
    
        return $this;
    }

    /**
     * Get groupeApprenants
     *
     * @return \SICLA\AraBundle\Entity\GroupeApprenants 
     */
    public function getGroupeApprenants()
    {
        return $this->groupeApprenants;
    }
}