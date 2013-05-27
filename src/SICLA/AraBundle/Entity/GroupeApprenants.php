<?php

namespace SICLA\AraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * StatutFamille
 *
 * @ORM\Table(name="ara_groupe_apprenants")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\StatutFamilleRepository")
 */
class GroupeApprenants
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
	* @ORM\OneToMany(targetEntity="SICLA\AraBundle\Entity\AffectationGroupe", mappedBy="groupeApprenants")
	*/
	 private $affectationsGroupes;

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
     * Add affectationGroupe
     *
     * @param \SICLA\AraBundle\Entity\AffectationGroupe $affectationGroupe
     * @return GroupeApprenants
     */
    public function addAffectationGroupe(\SICLA\AraBundle\Entity\AffectationGroupe $affectationGroupe)
    {
        $this->affectationsGroupes[] = $affectationGroupe;
		$affectationGroupe->setStatutFamille($this);
    
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
		$affectationGroupe->setStatutFamille(null);
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