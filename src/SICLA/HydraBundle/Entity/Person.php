<?php

namespace SICLA\HydraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Sidus\SidusBundle\Entity\Object;
/**
 * Person
 *
 * @ORM\Table(name="sicla_person"	)
 * @ORM\Entity(repositoryClass="SICLA\HydraBundle\Entity\PersonRepository")
 */
class Person extends Object
{
    /**
     * @var string
     *
     * @ORM\Column(name="firstName", type="string", length=255)
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(name="lastName", type="string", length=255)
     */
    private $lastName;

    /**
     * @var string
     *
     * @ORM\Column(name="maidenName", type="string", length=255, nullable=true)
     */
    private $maidenName;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="string", length=255)
     */
    private $gender;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="birthday", type="date", nullable=true)
     */
    private $birthday;
	
	/**
     * @Assert\Type(type="SICLA\HydraBundle\Entity\Phone")
	 * @ORM\OneToMany(targetEntity="SICLA\HydraBundle\Entity\Phone",cascade={"persist"}, mappedBy="person"))
     */
	private $phones;
	
	/**
     * @Assert\Type(type="SICLA\HydraBundle\Entity\Address")
	 * 
	 * @ORM\OneToMany(targetEntity="SICLA\HydraBundle\Entity\Address",cascade={"persist"}, mappedBy="person"))
	*/
	private $addresses;
	
	 public function __construct()
    {
        $this->phones= new ArrayCollection();
		$this->addresses= new ArrayCollection();
    }
	/**
     * Get id
     *
     * @return integer 
     */
	
    public function getId()
    {
        return parent::getId();
    }
	
    /**
     * Set firstName
     *
     * @param string $firstName
     * @return Person
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    
        return $this;
    }

    /**
     * Get firstName
     *
     * @return string 
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName
     *
     * @param string $lastName
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    
        return $this;
    }

    /**
     * Get lastName
     *
     * @return string 
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set maidenName
     *
     * @param string $maidenName
     * @return Person
     */
    public function setMaidenName($maidenName)
    {
        $this->maidenName = $maidenName;
    
        return $this;
    }

    /**
     * Get maidenName
     *
     * @return string 
     */
    public function getMaidenName()
    {
        return $this->maidenName;
    }

    /**
     * Set gender
     *
     * @param string $gender
     * @return Person
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    
        return $this;
    }

    /**
     * Get gender
     *
     * @return string 
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set birthday
     *
     * @param \DateTime $birthday
     * @return Person
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    
        return $this;
    }

    /**
     * Get birthday
     *
     * @return \DateTime 
     */
    public function getBirthday()
    {
        return $this->birthday;
    }
	
	

    /**
     * Add phones
     *
     * @param \SICLA\HydraBundle\Entity\Phone $phone
     * @return Person
     */
    public function addPhone(\SICLA\HydraBundle\Entity\Phone $phone)
    {
        $this->phones[] = $phone;
		$phone->setPerson($this);
        return $this;
    }

    /**
     * Remove phones
     *
     * @param \SICLA\HydraBundle\Entity\Phone $phone
     */
    public function removePhone(\SICLA\HydraBundle\Entity\Phone $phone)
    {
        $this->phones->removeElement($phone);
		$phone->setPerson(null);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPhones()
    {
        return $this->phones;
    }
	
	/**
	* Set comments
	*
	* @param \Doctrine\Common\Collections\Collection $comments
	*/
	
	public function setPhones(\Doctrine\Common\Collections\Collection $phones)
	{
		$this->phones = $phones;
	}

    /**
     * Add addresses
     *
     * @param \SICLA\HydraBundle\Entity\Address $addresses
     * @return Person
     */
    public function addAddresse(\SICLA\HydraBundle\Entity\Address $addresses)
    {
        $this->addresses[] = $addresses;
		$addresses->setPerson($this);
        return $this;
    }

    /**
     * Remove addresses
     *
     * @param \SICLA\HydraBundle\Entity\Address $addresses
     */
    public function removeAddresse(\SICLA\HydraBundle\Entity\Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAddresses()
    {
        return $this->addresses;
    }
}