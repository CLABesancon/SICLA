<?php

namespace SICLA\AraBundle\Entity;
use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * AffectationDemande
 *
 * @ORM\Table(name="ara_affectation_logement")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\AffectationLogementRepository")
 */
class AffectationLogement extends Object
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
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\Logement", inversedBy="affectations")
	* @ORM\JoinColumn(nullable=true)
	*/
   private $logement;
    
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
     * Set logement
     *
     * @param \SICLA\AraBundle\Entity\Logement $logement
     * @return AffectationDemande
     */
    public function setLogement(\SICLA\AraBundle\Entity\Logement $logement = null)
    {
        $this->logement= $logement;
    
        return $this;
    }

    /**
     * Get logement
     *
     * @return \SICLA\AraBundle\Entity\Logement
     */
    public function getLogement()
    {
        return $this->logement;
    }
   
  
    
}