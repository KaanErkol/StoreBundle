<?php
namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="attribute")
 */
class Attribute
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string",length=255)
     * @var string $name
     */
    protected $name;

    /**
     * @ORM\ManyToOne(targetEntity="AttributeGroup", inversedBy="attribute")
     * @ORM\JoinColumn(name="AttributeGroup_id", referencedColumnName="id")
     * @var array $attr_group
     */
    protected $attr_group;

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
     * @return Attribute
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
     * Set attr_group
     *
     * @param \Kaan\CoreBundle\Entity\AttributeGroup $attrGroup
     * @return Attribute
     */
    public function setAttrGroup(\Kaan\CoreBundle\Entity\AttributeGroup $attrGroup = null)
    {
        $this->attr_group = $attrGroup;
    
        return $this;
    }

    /**
     * Get attr_group
     *
     * @return \Kaan\CoreBundle\Entity\AttributeGroup 
     */
    public function getAttrGroup()
    {
        return $this->attr_group;
    }
}