<?php

namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="zones")
 */
class Zone {

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
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="create")
     * 
     * @var type datetime
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="datetime")
     * @Gedmo\Timestampable(on="update")
     * 
     * @var type datetime
     */
    protected $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="Country")
     * @ORM\JoinTable(name="zone_lists",
     *     joinColumns={@ORM\JoinColumn(name="zone_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="country_id", referencedColumnName="id")}
     * )
     * @var type array
     */
    protected $child;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Zone
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Zone
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Constructor
     */
    public function __construct() {
        $this->child = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add child
     *
     * @param \Kaan\CoreBundle\Entity\Country $child
     * @return Zone
     */
    public function addChild(\Kaan\CoreBundle\Entity\Country $child) {
        $this->child[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Kaan\CoreBundle\Entity\Country $child
     */
    public function removeChild(\Kaan\CoreBundle\Entity\Country $child) {
        $this->child->removeElement($child);
    }

    /**
     * Get child
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChild() {
        return $this->child;
    }


    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return Zone
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
}