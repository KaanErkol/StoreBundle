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
     * @ORM\Column(type="string",length=255,nullable=TRUE)
     * @var string $name
     */
    protected $name;
    /**
     * @ORM\Column(type="text",nullable=TRUE)
     * @var text $description;
     */
    protected $description;
    /**
     * @ORM\Column(type="string",length=255,nullable=TRUE)
     * @var string $permalink
     */
    protected $permalink;
    
    /**
     * @ORM\Column(type="string",length=255,unique=TRUE,nullable=TRUE)
     * 
     * @var string
     */
    protected $sku;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @var datetime
     */
    protected $avaibleOn;
    
    /**
     * @ORM\Column(type="boolean",nullable=TRUE)
     * @var boolean
     */
    protected $avaible;


    /**
     * @ORM\Column(type="string",length=50)
     * 
     * @var string
     */
    protected $price;
    
    /**
     * @ORM\Column(type="integer")
     * 
     * @var integer
     */
    protected $stock;
    
    /**
     * @ORM\ManyToOne(targetEntity="ShippingCategory", inversedBy="product")
     * @ORM\JoinColumn(name="shipping_category", referencedColumnName="id")
     * 
     * @var string
     */
    protected $shippingCategory;
    
    /**
     * @ORM\Column(type="string",length=255, nullable=TRUE)
     * 
     * @var string
     */
    protected $image;
    
    /**
     * @ORM\ManyToOne(targetEntity="Taxation", inversedBy="product")
     * @ORM\JoinColumn(name="taxation_category", referencedColumnName="id")
     * 
     * @var string
     */
    protected $taxationCategory;
    
    /**
     * @ORM\Column(type="integer",nullable=TRUE)
     * 
     * @var integer
     */
    protected $variantMode;
    
    /**
     * @ORM\ManyToMany(targetEntity="Taxonomies");
     * @ORM\JoinTable(name="product_taxonomies",
     *     joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="taxonomies_id", referencedColumnName="id")}
     * )
     * 
     * @var array
     */    
    protected $taxonomies;


    /**
     * @ORM\ManyToMany(targetEntity="Option");
     * @ORM\JoinTable(name="product_option",
     *     joinColumns={@ORM\JoinColumn(name="product_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="option_id", referencedColumnName="id")}
     * )
     * 
     * @var array
     */
    protected $options;

    /**
     * @ORM\OneToMany(targetEntity="ProductAttribute", mappedBy="product",cascade={"persist"})
     */
    protected $attribute;
    
    /**
     * @ORM\Column(type="integer")
     * 
     * @var integer
     */
    protected $type;
    
    /**
     * @ORM\ManyToOne(targetEntity="Product", inversedBy="product");
     * @ORM\JoinColumn(name="parent_id", referencedColumnName="id", nullable=TRUE)
     * 
     * @var get parent product
     */
    protected $parentProduct;
    
    /**
     * @ORM\OneToMany(targetEntity="Product", mappedBy="parentProduct")
     * 
     * @var array
     */
    protected $children;
    
    /**
     * @ORM\ManyToMany(targetEntity="OptionValue");
     * @ORM\JoinTable(name="product_variant_option",
     *     joinColumns={@ORM\JoinColumn(name="variant_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="optionvalue_id", referencedColumnName="id")}
     * )
     * 
     * @var array
     */
    protected $variantOptions;

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

    /**
     * Set sku
     *
     * @param string $sku
     * @return Product
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    
        return $this;
    }

    /**
     * Get sku
     *
     * @return string 
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * Set avaibleOn
     *
     * @param \DateTime $avaibleOn
     * @return Product
     */
    public function setAvaibleOn($avaibleOn)
    {
        $this->avaibleOn = $avaibleOn;
    
        return $this;
    }

    /**
     * Get avaibleOn
     *
     * @return \DateTime 
     */
    public function getAvaibleOn()
    {
        return $this->avaibleOn;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set stock
     *
     * @param integer $stock
     * @return Product
     */
    public function setStock($stock)
    {
        $this->stock = $stock;
    
        return $this;
    }

    /**
     * Get stock
     *
     * @return integer 
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set image
     *
     * @param string $image
     * @return Product
     */
    public function setImage($image)
    {
        $this->image = $image;
    
        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set variantMode
     *
     * @param integer $variantMode
     * @return Product
     */
    public function setVariantMode($variantMode)
    {
        $this->variantMode = $variantMode;
    
        return $this;
    }

    /**
     * Get variantMode
     *
     * @return integer 
     */
    public function getVariantMode()
    {
        return $this->variantMode;
    }

    /**
     * Set shippingCategory
     *
     * @param \Kaan\CoreBundle\Entity\ShippingCategory $shippingCategory
     * @return Product
     */
    public function setShippingCategory(\Kaan\CoreBundle\Entity\ShippingCategory $shippingCategory = null)
    {
        $this->shippingCategory = $shippingCategory;
    
        return $this;
    }

    /**
     * Get shippingCategory
     *
     * @return \Kaan\CoreBundle\Entity\ShippingCategory 
     */
    public function getShippingCategory()
    {
        return $this->shippingCategory;
    }

    /**
     * Set taxationCategory
     *
     * @param \Kaan\CoreBundle\Entity\Taxation $taxationCategory
     * @return Product
     */
    public function setTaxationCategory(\Kaan\CoreBundle\Entity\Taxation $taxationCategory = null)
    {
        $this->taxationCategory = $taxationCategory;
    
        return $this;
    }

    /**
     * Get taxationCategory
     *
     * @return \Kaan\CoreBundle\Entity\Taxation 
     */
    public function getTaxationCategory()
    {
        return $this->taxationCategory;
    }

    /**
     * Add taxonomies
     *
     * @param \Kaan\CoreBundle\Entity\Taxonimes $taxonomies
     * @return Product
     */
    public function addTaxonomies(\Kaan\CoreBundle\Entity\Taxonomies $taxonomies)
    {
        $this->taxonomies[] = $taxonomies;
    
        return $this;
    }

    /**
     * Remove taxonomies
     *
     * @param \Kaan\CoreBundle\Entity\Taxonimes $taxonomies
     */
    public function removeTaxonomies(\Kaan\CoreBundle\Entity\Taxonomies $taxonomies)
    {
        $this->taxonomies->removeElement($taxonomies);
    }

    /**
     * Get taxonomies
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTaxonomies()
    {
        return $this->taxonomies;
    }

    /**
     * Add options
     *
     * @param \Kaan\CoreBundle\Entity\Option $options
     * @return Product
     */
    public function addOption(\Kaan\CoreBundle\Entity\Option $options)
    {
        $this->options[] = $options;
    
        return $this;
    }

    /**
     * Remove options
     *
     * @param \Kaan\CoreBundle\Entity\Option $options
     */
    public function removeOption(\Kaan\CoreBundle\Entity\Option $options)
    {
        $this->options->removeElement($options);
    }

    /**
     * Get options
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * Add taxonomies
     *
     * @param \Kaan\CoreBundle\Entity\Taxonomies $taxonomies
     * @return Product
     */
    public function addTaxonomie(\Kaan\CoreBundle\Entity\Taxonomies $taxonomies)
    {
        $this->taxonomies[] = $taxonomies;
    
        return $this;
    }

    /**
     * Remove taxonomies
     *
     * @param \Kaan\CoreBundle\Entity\Taxonomies $taxonomies
     */
    public function removeTaxonomie(\Kaan\CoreBundle\Entity\Taxonomies $taxonomies)
    {
        $this->taxonomies->removeElement($taxonomies);
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return Product
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set parentProduct
     *
     * @param \Kaan\CoreBundle\Entity\Product $parentProduct
     * @return Product
     */
    public function setParentProduct(\Kaan\CoreBundle\Entity\Product $parentProduct = null)
    {
        $this->parentProduct = $parentProduct;
    
        return $this;
    }

    /**
     * Get parentProduct
     *
     * @return \Kaan\CoreBundle\Entity\Product 
     */
    public function getParentProduct()
    {
        return $this->parentProduct;
    }

    /**
     * Add children
     *
     * @param \Kaan\CoreBundle\Entity\Product $children
     * @return Product
     */
    public function addChildren(\Kaan\CoreBundle\Entity\Product $children)
    {
        $this->children[] = $children;
    
        return $this;
    }

    /**
     * Remove children
     *
     * @param \Kaan\CoreBundle\Entity\Product $children
     */
    public function removeChildren(\Kaan\CoreBundle\Entity\Product $children)
    {
        $this->children->removeElement($children);
    }

    /**
     * Get children
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getChildren()
    {
        return $this->children;
    }

    /**
     * Set avaible
     *
     * @param boolean $avaible
     * @return Product
     */
    public function setAvaible($avaible)
    {
        $this->avaible = $avaible;
    
        return $this;
    }

    /**
     * Get avaible
     *
     * @return boolean 
     */
    public function getAvaible()
    {
        return $this->avaible;
    }

    /**
     * Add variantOptions
     *
     * @param \Kaan\CoreBundle\Entity\OptionValue $variantOptions
     * @return Product
     */
    public function addVariantOption(\Kaan\CoreBundle\Entity\OptionValue $variantOptions)
    {
        $this->variantOptions[] = $variantOptions;
    
        return $this;
    }

    /**
     * Remove variantOptions
     *
     * @param \Kaan\CoreBundle\Entity\OptionValue $variantOptions
     */
    public function removeVariantOption(\Kaan\CoreBundle\Entity\OptionValue $variantOptions)
    {
        $this->variantOptions->removeElement($variantOptions);
    }

    /**
     * Get variantOptions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getVariantOptions()
    {
        return $this->variantOptions;
    }
}