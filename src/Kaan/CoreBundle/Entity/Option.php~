<?php

namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="options")
 */
class Option {

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
     * @var string $name
     */
    protected $name;

    /**
     * @ORM\Column(type="string",length=255)
     * @var string
     */
    protected $presentation;

    /**
     * @ORM\OneToMany(targetEntity="OptionValue", mappedBy="option",cascade={"persist"});
     * 
     * @var array
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
     * @return Option
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
     * Set presentation
     *
     * @param string $presentation
     * @return Option
     */
    public function setPresentation($presentation) {
        $this->presentation = $presentation;

        return $this;
    }

    /**
     * Get presentation
     *
     * @return string 
     */
    public function getPresentation() {
        return $this->presentation;
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
     * @param \Kaan\CoreBundle\Entity\OptionValue $child
     * @return Option
     */
    public function addChild(\Kaan\CoreBundle\Entity\OptionValue $child) {
        $this->child[] = $child;

        return $this;
    }

    /**
     * Remove child
     *
     * @param \Kaan\CoreBundle\Entity\OptionValue $child
     */
    public function removeChild(\Kaan\CoreBundle\Entity\OptionValue $child) {
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

    public function __toString() {
        return $this->name;
    }

    public function setChild(ArrayCollection $option) {
        die();
        foreach ($option as $tag) {
            $tag->addChild($this);
        }

        $this->child = $$option;
    }

}