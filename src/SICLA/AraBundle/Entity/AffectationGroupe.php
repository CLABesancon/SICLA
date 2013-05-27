<?php

namespace SICLA\AraBundle\Entity;

use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * AffectationGroupe
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\AffectationGroupeRepository")
 */
class AffectationGroupe extends Object
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="date")
     */
    private $dateFin;
	
	/**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\FamilleAccueil", inversedBy="affectationsGroupes")
	* @ORM\JoinColumn(nullable=true)
	*/
   private $famille;
   
    /**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\GroupeApprenants", inversedBy="affectationsGroupes")
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     * @return AffectationGroupe
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;
    
        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime 
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     * @return AffectationGroupe
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;
    
        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime 
     */
    public function getDateFin()
    {
        return $this->dateFin;
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
     * @param \SICLA\AraBundle\Entity\GroupeApprenants $statutFamille
     * @return AffectationGroupe
     */
    public function setStatutFamille(\SICLA\AraBundle\Entity\GroupeApprenants $statutFamille = null)
    {
        $this->statutFamille = $statutFamille;
    
        return $this;
    }

    /**
     * Get statutFamille
     *
     * @return \SICLA\AraBundle\Entity\GroupeApprenants 
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