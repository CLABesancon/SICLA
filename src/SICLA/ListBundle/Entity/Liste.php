<?php

namespace SICLA\ListBundle\Entity;

use Sidus\SidusBundle\Entity\Object;
use Doctrine\ORM\Mapping as ORM;

/**
 * List
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="SICLA\ListeBundle\Entity\ListRepository")
 */
class Liste extends Object
{
    /**
     * @var string
     *
     * @ORM\Column(name="entity", type="string", length=255)
     */
    private $entity;
	
    /**
     * Set entity
     *
     * @param string $entity
     * @return List
     */
    public function setEntity($entity)
    {
        $this->entity = $entity;
    
        return $this;
    }

    /**
     * Get entity
     *
     * @return string 
     */
    public function getEntity()
    {
        return $this->entity;
    }
}
