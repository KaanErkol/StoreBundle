<?php
namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product")
 */
class Product
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
     * @ORM\Column(type="text")
     * @var text $description;
     */
    protected $description;
    /**
     * @ORM\Column(type="string",length=255)
     * @var string $permalink
     */
    protected $permalink;


    /**
     * @ORM\OneToMany(targetEntity="ProductAttribute", mappedBy="product",cascade={"remove"})
     */
    protected  $attribute;

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
     * @return Product
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
     * Set description
     *
     * @param string $description
     * @return Product
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set permalink
     *
     * @param string $permalink
     * @return Product
     */
    public function setPermalink($permalink)
    {
        $this->permalink = $permalink;
    
        return $this;
    }

    /**
     * Get permalink
     *
     * @return string 
     */
    public function getPermalink()
    {
        return $this->permalink;
    }

    /**
     * Add attribute
     *
     * @param \Kaan\CoreBundle\Entity\ProductAttribute $attribute
     * @return Product
     */
    public function addAttribute(\Kaan\CoreBundle\Entity\ProductAttribute $attribute)
    {
        $this->attribute[] = $attribute;
    
        return $this;
    }

    /**
     * Remove attribute
     *
     * @param \Kaan\CoreBundle\Entity\ProductAttribute $attribute
     */
    public function removeAttribute(\Kaan\CoreBundle\Entity\ProductAttribute $attribute)
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