<?php
namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="country")
 */

class Country 
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer") 
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var type string
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string",length=255)
     * 
     * @var type string
     */
    protected $name;
    /**
     * @ORM\Column(type="string",length=255)
     * 
     * @var type string
     */
    protected $isocode;
    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     * 
     * @var type datetime
     */
    protected $createdAt;


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
     * @return Country
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
     * Set isocode
     *
     * @param string $isocode
     * @return Country
     */
    public function setIsocode($isocode)
    {
        $this->isocode = $isocode;
    
        return $this;
    }

    /**
     * Get isocode
     *
     * @return string 
     */
    public function getIsocode()
    {
        return $this->isocode;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Country
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
    
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
    
    public function __toString() {
        return $this->getName();
    }

}