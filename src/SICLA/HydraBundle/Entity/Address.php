<?php

namespace SICLA\HydraBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * address
 *
 * @ORM\Table(name="sicla_address"	)
 * @ORM\Entity(repositoryClass="SICLA\HydraBundle\Entity\AddressRepository")
 */
class Address
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
     * @var integer
     *
     * @ORM\Column(name="streetNumber", type="integer")
     */
    private $streetNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="streetNumberSuffix", type="string", length=255)
     */
    private $streetNumberSuffix;

    /**
     * @var string
     *
     * @ORM\Column(name="streetType", type="string", length=255)
     */
    private $streetType;

    /**
     * @var string
     *
     * @ORM\Column(name="streetName", type="string", length=255)
     */
    private $streetName;

    /**
     * @var string
     *
     * @ORM\Column(name="addressType", type="string", length=255)
     */
    private $addressType;

    /**
     * @var integer
     *
     * @ORM\Column(name="addressTypeNumber", type="integer")
     */
    private $addressTypeNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="minorMunicipality", type="string", length=255)
     */
    private $minorMunicipality;

    /**
     * @var string
     *
     * @ORM\Column(name="majorMunicipality", type="string", length=255)
     */
    private $majorMunicipality;

    /**
     * @var string
     *
     * @ORM\Column(name="governinsDistrict", type="string", length=255)
     */
    private $governinsDistrict;

    /**
     * @var string
     *
     * @ORM\Column(name="postalCode", type="string", length=10)
     */
    private $postalCode;

    /**
     * @var string
     *
     * @ORM\Column(name="country", type="string", length=255)
     */
    private $country;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="cedex", type="boolean")
     */
    private $cedex;
	
	 /**
     * @var string
     *
     * @ORM\Column(name="cedexNumber", type="string", length=255)
     */
    private $cedexNumber;
	
	/**
     * @var string
     *
     * @ORM\Column(name="postofficeNumber", type="string", length=255)
     */
    private $postofficeNumber;
	
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
     * Set streetNumber
     *
     * @param integer $streetNumber
     * @return address
     */
    public function setStreetNumber($streetNumber)
    {
        $this->streetNumber = $streetNumber;
    
        return $this;
    }

    /**
     * Get streetNumber
     *
     * @return integer 
     */
    public function getStreetNumber()
    {
        return $this->streetNumber;
    }

    /**
     * Set streetNumberSuffix
     *
     * @param string $streetNumberSuffix
     * @return address
     */
    public function setStreetNumberSuffix($streetNumberSuffix)
    {
        $this->streetNumberSuffix = $streetNumberSuffix;
    
        return $this;
    }

    /**
     * Get streetNumberSuffix
     *
     * @return string 
     */
    public function getStreetNumberSuffix()
    {
        return $this->streetNumberSuffix;
    }

    /**
     * Set streetType
     *
     * @param string $streetType
     * @return address
     */
    public function setStreetType($streetType)
    {
        $this->streetType = $streetType;
    
        return $this;
    }

    /**
     * Get streetType
     *
     * @return string 
     */
    public function getStreetType()
    {
        return $this->streetType;
    }

    /**
     * Set streetName
     *
     * @param string $streetName
     * @return address
     */
    public function setStreetName($streetName)
    {
        $this->streetName = $streetName;
    
        return $this;
    }

    /**
     * Get streetName
     *
     * @return string 
     */
    public function getStreetName()
    {
        return $this->streetName;
    }

    /**
     * Set addressType
     *
     * @param string $addressType
     * @return address
     */
    public function setAddressType($addressType)
    {
        $this->addressType = $addressType;
    
        return $this;
    }

    /**
     * Get addressType
     *
     * @return string 
     */
    public function getAddressType()
    {
        return $this->addressType;
    }

    /**
     * Set adressTypeNumber
     *
     * @param integer $adressTypeNumber
     * @return address
     */
    public function setAddressTypeNumber($addressTypeNumber)
    {
        $this->addressTypeNumber = $addressTypeNumber;
    
        return $this;
    }

    /**
     * Get addressTypeNumber
     *
     * @return integer 
     */
    public function getAddressTypeNumber()
    {
        return $this->addressTypeNumber;
    }

    /**
     * Set minorMunicipality
     *
     * @param string $minorMunicipality
     * @return address
     */
    public function setMinorMunicipality($minorMunicipality)
    {
        $this->minorMunicipality = $minorMunicipality;
    
        return $this;
    }

    /**
     * Get minorMunicipality
     *
     * @return string 
     */
    public function getMinorMunicipality()
    {
        return $this->minorMunicipality;
    }

    /**
     * Set majorMunicipality
     *
     * @param string $majorMunicipality
     * @return address
     */
    public function setMajorMunicipality($majorMunicipality)
    {
        $this->majorMunicipality = $majorMunicipality;
    
        return $this;
    }

    /**
     * Get majorMunicipality
     *
     * @return string 
     */
    public function getMajorMunicipality()
    {
        return $this->majorMunicipality;
    }

    /**
     * Set governinsDistrict
     *
     * @param string $governinsDistrict
     * @return address
     */
    public function setGoverninsDistrict($governinsDistrict)
    {
        $this->governinsDistrict = $governinsDistrict;
    
        return $this;
    }

    /**
     * Get governinsDistrict
     *
     * @return string 
     */
    public function getGoverninsDistrict()
    {
        return $this->governinsDistrict;
    }

    /**
     * Set postalCode
     *
     * @param string $postalCode
     * @return address
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    
        return $this;
    }

    /**
     * Get postalCode
     *
     * @return string 
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return address
     */
    public function setCountry($country)
    {
        $this->country = $country;
    
        return $this;
    }

    /**
     * Get country
     *
     * @return string 
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set cedex
     *
     * @param boolean $cedex
     * @return Address
     */
    public function setCedex($cedex)
    {
        $this->cedex = $cedex;
    
        return $this;
    }

    /**
     * Get cedex
     *
     * @return boolean 
     */
    public function getCedex()
    {
        return $this->cedex;
    }

    /**
     * Set cedexNumber
     *
     * @param string $cedexNumber
     * @return Address
     */
    public function setCedexNumber($cedexNumber)
    {
        $this->cedexNumber = $cedexNumber;
    
        return $this;
    }

    /**
     * Get cedexNumber
     *
     * @return string 
     */
    public function getCedexNumber()
    {
        return $this->cedexNumber;
    }

    /**
     * Set postofficeNumber
     *
     * @param string $postofficeNumber
     * @return Address
     */
    public function setPostofficeNumber($postofficeNumber)
    {
        $this->postofficeNumber = $postofficeNumber;
    
        return $this;
    }

    /**
     * Get postofficeNumber
     *
     * @return string 
     */
    public function getPostofficeNumber()
    {
        return $this->postofficeNumber;
    }
}