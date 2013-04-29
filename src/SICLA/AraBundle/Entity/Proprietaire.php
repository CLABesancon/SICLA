<?php

namespace SICLA\AraBundle\Entity;
use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * Proprietaire
 *
 * @ORM\Table(name="ara_proprietaire")
 * @ORM\Entity(repositoryClass="SICLA\AraBundle\Entity\ProprietaireRepository")
 */
class Proprietaire extends Object
{
    /**
     * @var string
     *
     * @ORM\Column(name="telephone2", type="string", length=255)
     */
    private $telephone2;

    /**
     * @var string
     *
     * @ORM\Column(name="courrier2", type="string", length=255)
     */
    private $courriel2;

    /**
     * Set telephone2
     *
     * @param string $telephone2
     * @return Proprietaire
     */
    public function setTelephone2($telephone2)
    {
        $this->telephone2 = $telephone2;
    
        return $this;
    }

    /**
     * Get telephone2
     *
     * @return string 
     */
    public function getTelephone2()
    {
        return $this->telephone2;
    }

    /**
     * Set courriel2
     *
     * @param string $courriel2
     * @return Proprietaire
     */
    public function setCourriel2($courriel2)
    {
        $this->courriel2 = $courriel2;
    
        return $this;
    }

    /**
     * Get courriel2
     *
     * @return string 
     */
    public function getCourriel2()
    {
        return $this->courriel2;
    }
	
	
}