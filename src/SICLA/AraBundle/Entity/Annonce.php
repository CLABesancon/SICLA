<?php

namespace SICLA\AraBundle\Entity;

use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * Annonce
 *
 * @ORM\Table(name="ara_annonce")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\AnnonceRepository")
 */
class Annonce extends Object
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
     * @ORM\Column(name="annonce", type="text")
     */
    private $annonce;
	
	/**
	* @ORM\ManyToOne(targetEntity="SICLA\AraBundle\Entity\StatutAnnonce")
	* @ORM\JoinColumn( nullable=false )
	* 
	*/
	private $statut;


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
     * Set annonce
     *
     * @param string $annonce
     * @return Annonce
     */
    public function setAnnonce($annonce)
    {
        $this->annonce = $annonce;
    
        return $this;
    }

    /**
     * Get annonce
     *
     * @return string 
     */
    public function getAnnonce()
    {
        return $this->annonce;
    }

    /**
     * Set statut
     *
     * @param \SICLA\AraBundle\Entity\StatutAnnonce $statut
     * @return Annonce
     */
    public function setStatut(\SICLA\AraBundle\Entity\StatutAnnonce $statut)
    {
        $this->statut = $statut;
    
        return $this;
    }

    /**
     * Get statut
     *
     * @return \SICLA\AraBundle\Entity\StatutAnnonce 
     */
    public function getStatut()
    {
        return $this->statut;
    }
}