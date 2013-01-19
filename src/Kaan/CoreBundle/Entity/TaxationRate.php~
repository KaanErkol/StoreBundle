<?php

namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="taxation_rate")
 */
class TaxationRate {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=128)
     * 
     * @var type string
     */
    protected $name;


    /**
     * @ORM\ManyToOne(targetEntity="Taxation", inversedBy="category")
     * @ORM\JoinColumn(name="taxation_id",referencedColumnName="id")
     * 
     * @var type object
     */
    protected $category;


    /**
     * @ORM\Column(type="integer")
     * 
     * @var type integer
     */
    protected $amount;
    
    /**
     * @ORM\ManyToOne(targetEntity="Zone", inversedBy="zone")
     * @ORM\JoinColumn(name="zone_id",referencedColumnName="id")
     * 
     * @var type Array;
     */
    protected $zone;
    
    /**
     * @ORM\Column(type="boolean")
     * 
     * @var type boolean
     */
    protected $includePrice;


    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     * 
     * @var type datetime
     */
    protected $updatedAt;


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
     * Set name
     *
     * @param string $name
     * @return TaxationRate
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set amount
     *
     * @param integer $amount
     * @return TaxationRate
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return integer 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set includePrice
     *
     * @param boolean $includePrice
     * @return TaxationRate
     */
    public function setIncludePrice($includePrice)
    {
        $this->includePrice = $includePrice;
    
        return $this;
    }

    /**
     * Get includePrice
     *
     * @return boolean 
     */
    public function getIncludePrice()
    {
        return $this->includePrice;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return TaxationRate
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;
    
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set category
     *
     * @param \Kaan\CoreBundle\Entity\Taxation $category
     * @return TaxationRate
     */
    public function setCategory(\Kaan\CoreBundle\Entity\Taxation $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \Kaan\CoreBundle\Entity\Taxation 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set zone
     *
     * @param \Kaan\CoreBundle\Entity\Zone $zone
     * @return TaxationRate
     */
    public function setZone(\Kaan\CoreBundle\Entity\Zone $zone = null)
    {
        $this->zone = $zone;
    
        return $this;
    }

    /**
     * Get zone
     *
     * @return \Kaan\CoreBundle\Entity\Zone 
     */
    public function getZone()
    {
        return $this->zone;
    }
}