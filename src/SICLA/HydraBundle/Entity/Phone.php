<?php

namespace SICLA\HydraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Phone
 *
 * @ORM\Table(name="sicla_phone")
 * @ORM\Entity(repositoryClass="SICLA\HydraBundle\Entity\PhoneRepository")
 */
class Phone
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
     * @ORM\Column(name="diallingCode", type="string", length=5)
     */
    private $diallingCode;

    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=255)
     */
    private $phoneNumber;
	
	/**
	* @ORM\ManyToOne(targetEntity="SICLA\HydraBundle\Entity\Person", inversedBy="phones")
	* @ORM\JoinColumn(name="person_id", referencedColumnName="id"))
	*/
	protected $person;

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
     * Set diallingCode
     *
     * @param string $diallingCode
     * @return Phone
     */
    public function setDiallingCode($diallingCode)
    {
        $this->diallingCode = $diallingCode;
    
        return $this;
    }

    /**
     * Get diallingCode
     *
     * @return string 
     */
    public function getDiallingCode()
    {
        return $this->diallingCode;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     * @return Phone
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    
        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string 
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Set person
     *
     * @param \SICLA\HydraBundle\Entity\Person $person
     * @return Phone
     */
    public function setPerson(\SICLA\HydraBundle\Entity\Person $person)
    {
        $this->person = $person;
    
        return $this;
    }

    /**
     * Get person
     *
     * @return \SICLA\HydraBundle\Entity\Person 
     */
    public function getPerson()
    {
        return $this->person;
    }
}