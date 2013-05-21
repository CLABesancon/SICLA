<?php

namespace SICLA\AraBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
 
/**
 * @ORM\Entity
 */

class AffectationDemande {
	
	/**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\FamilleAccueil")
   */
	private $famille;
	
	/**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\ApprenantDemandeLogement")
   */
	private $demande;
	
	/**
   * @ORM\Column()
   */
	private $dateArrivee;
	
	
	/**
   * @ORM\Column()
   */
	private $dateDepart;

    /**
     * Set dateArrivee
     *
     * @param string $dateArrivee
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
     * @return string 
     */
    public function getDateArrivee()
    {
        return $this->dateArrivee;
    }

    /**
     * Set dateDepart
     *
     * @param string $dateDepart
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
     * @return string 
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set famille
     *
     * @param \SICLA\AraBundle\Entity\FamilleAccueil $famille
     * @return AffectationDemande
     */
    public function setFamille(\SICLA\AraBundle\Entity\FamilleAccueil $famille)
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
}