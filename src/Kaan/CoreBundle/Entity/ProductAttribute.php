<?php
namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="product_attribute")
 */
class ProductAttribute
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
     * @var string $value;
     */
    protected $value;
    /**
     * @ORM\ManyToOne(targetEntity="Attribute", inversedBy="productattribute")
     * @ORM\JoinColumn(name="Attribute_id", referencedColumnName="id")
     * @var array $attribute
     */
    protected $attribute;

    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="productattribute")
     * @ORM\JoinColumn(name="Product_id", referencedColumnName="id")
     * @var array $product
     */
    protected $product;
    
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
     * Set value
     *
     * @param string $value
     * @return ProductAttribute
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }


    /**
     * Set attribute
     *
     * @param \Kaan\CoreBundle\Entity\Attribute $attribute
     * @return ProductAttribute
     */
    public function setAttribute(\Kaan\CoreBundle\Entity\Attribute $attribute = null)
    {
        $this->attribute = $attribute;
    
        return $this;
    }

    /**
     * Get attribute
     *
     * @return \Kaan\CoreBundle\Entity\Attribute 
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

    /**
     * Set product
     *
     * @param \Kaan\CoreBundle\Entity\Product $product
     * @return ProductAttribute
     */
    public function setProduct(\Kaan\CoreBundle\Entity\Product $product = null)
    {
        $this->product = $product;
    
        return $this;
    }

    /**
     * Get product
     *
     * @return \Kaan\CoreBundle\Entity\Product 
     */
    public function getProduct()
    {
        return $this->product;
    }
    public function __toString() {
        return $this->getAttribute()->getName();
    }
}