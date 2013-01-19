<?php
namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="attribute_group")
 */
class AttributeGroup
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
     * @ORM\OneToMany(targetEntity="Attribute", mappedBy="attributegroup")
     * *
     * @var ArrayCollection $attribute
     */
    protected $attribute;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->attribute = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
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
     * @return AttributeGroup
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
     * Add attribute
     *
     * @param \Kaan\CoreBundle\Entity\Attribute $attribute
     * @return AttributeGroup
     */
    public function addAttribute(\Kaan\CoreBundle\Entity\Attribute $attribute)
    {
        $this->attribute[] = $attribute;
    
        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \Kaan\CoreBundle\Entity\Attribute $attribute
     */
    public function removeAttribute(\Kaan\CoreBundle\Entity\Attribute $attribute)
    {
        $this->attribute->removeElement($attribute);
    }

    /**
     * Get attribute
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAttribute()
    {
        return $this->attribute;
    }
}