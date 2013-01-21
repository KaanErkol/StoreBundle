<?php

namespace Kaan\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="option_value")
 */
class OptionValue {

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
    protected $value;

    /**
     * @ORM\ManyToOne(targetEntity="Option", inversedBy="child",cascade={"persist"})
     * @ORM\JoinColumn(name="option_id",referencedColumnName="id")
     * 
     * @var string
     */
    protected $option;


        /**
     * Get id
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return OptionValue
     */
    public function setValue($value) {
        $this->value = $value;

        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue() {
        return $this->value;
    }

    /**
     * Set option
     *
     * @param \Kaan\CoreBundle\Entity\Option $option
     * @return OptionValue
     */
    public function setOption(\Kaan\CoreBundle\Entity\Option $option = null) {
        $this->option = $option;

        return $this;
    }

    /**
     * Get option
     *
     * @return \Kaan\CoreBundle\Entity\Option 
     */
    public function getOption() {
        return $this->option;
    }

    public function __toString() {
        return $this->getValue();
    }

    public function addOption(Option $option) {
        die();
        if (!$this->option->contains($option)) {
            $this->option->add($option);
        }
    }

}