<?php

namespace SICLA\AraBundle\Entity;
use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * AffectationDemande
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\AffectationDemandeRepository")
 */
class AffectationDemande extends Object
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
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\ApprenantDemandeLogement", inversedBy="affectations")
	* @ORM\JoinColumn(nullable=true)
	*/
   private $demande;
   
	/**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\FamilleAccueil", inversedBy="affectationsDemandes")
	* @ORM\JoinColumn(nullable=true)
	*/
   private $famille;
   
    /**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\StatutFamille", inversedBy="affectationsDemandes")
	* @ORM\JoinColumn(nullable=true)
	*/
   private $statutFamille;
   
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
     * Set demande
     *
     * @param \SICLA\AraBundle\Entity\ApprenantDemandeLogement $demande
     * @return AffectationDemande
     */
    public function setDemande(\SICLA\AraBundle\Entity\ApprenantDemandeLogement $demande)
    {
        $this->demande = $demande;
    
        return $this;
    }

    /**
     * Get demande
     *
     * @return \SICLA\AraBundle\Entity\ApprenantDemandeLogement 
     */
    public function getDemande()
    {
        return $this->demande;
    }
    
    /**
     * Set famille
     *
     * @param \SICLA\AraBundle\Entity\FamilleAccueil $famille
     * @return AffectationDemande
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

    
}