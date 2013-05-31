<?php

namespace SICLA\AraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatutFamille
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\StatutFamilleRepository")
 */
class StatutFamille
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
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;
	
	 /**
	* @ORM\OneToMany(targetEntity="SICLA\AraBundle\Entity\AffectationGroupe", mappedBy="statutFamille")
	*/
	 private $affectationsGroupes;
	 
	 	 /**
	* @ORM\OneToMany(targetEntity="SICLA\AraBundle\Entity\AffectationDemande", mappedBy="statutFamille")
	*/
	 private $affectationsDemandes;

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
     * Set libelle
     *
     * @param string $libelle
     * @return StatutFamille
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;
    
        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->affectationsGroupes = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add affectationGroupes
     *
     * @param \SICLA\AraBundle\Entity\AffectationGroupe $affectationGroupe
     * @return StatutFamille
     */
    public function addAffectationGroupe(\SICLA\AraBundle\Entity\AffectationGroupe $affectationGroupe)
    {
        $this->affectationsGroupes[] = $affectationGroupe;
		$affectationGroupe->setGroupeApprenants($this);
        return $this;
    }

    /**
     * Remove affectationGroupe
     *
     * @param \SICLA\AraBundle\Entity\AffectationGroupe $affectationGroupe
     */
    public function removeAffectationGroupe(\SICLA\AraBundle\Entity\AffectationGroupe $affectationGroupe)
    {
        $this->affectationsGroupes->removeElement($affectationGroupe);
		$affectationGroupe->setGroupeApprenants(null);
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

    /**
     * Add affectationsGroupes
     *
     * @param \SICLA\AraBundle\Entity\AffectationGroupe $affectationsGroupes
     * @return StatutFamille
     */
    public function addAffectationsGroupe(\SICLA\AraBundle\Entity\AffectationGroupe $affectationsGroupes)
    {
        $this->affectationsGroupes[] = $affectationsGroupes;
    
        return $this;
    }

    /**
     * Remove affectationsGroupes
     *
     * @param \SICLA\AraBundle\Entity\AffectationGroupe $affectationsGroupes
     */
    public function removeAffectationsGroupe(\SICLA\AraBundle\Entity\AffectationGroupe $affectationsGroupes)
    {
        $this->affectationsGroupes->removeElement($affectationsGroupes);
    }

    /**
     * Add affectationsDemandes
     *
     * @param \SICLA\AraBundle\Entity\AffectationDemande $affectationsDemandes
     * @return StatutFamille
     */
    public function addAffectationsDemande(\SICLA\AraBundle\Entity\AffectationDemande $affectationsDemandes)
    {
        $this->affectationsDemandes[] = $affectationsDemandes;
    
        return $this;
    }

    /**
     * Remove affectationsDemandes
     *
     * @param \SICLA\AraBundle\Entity\AffectationDemande $affectationsDemandes
     */
    public function removeAffectationsDemande(\SICLA\AraBundle\Entity\AffectationDemande $affectationsDemandes)
    {
        $this->affectationsDemandes->removeElement($affectationsDemandes);
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
}