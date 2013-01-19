<?php

namespace Kaan\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="groups")
 */
class Group {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string $name
     */
    protected $name;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_group_role",
     *     joinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection $groupRole
     */
    protected $groupRole;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     *
     * @var DateTime $createdAt
     */
    protected $createdAt;

    /**
     * Gets the id.
     *
     * @return integer The id.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Gets the role name.
     *
     * @return string The name.
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets the role name.
     *
     * @param string $value The name.
     */
    public function setName($value) {
        $this->name = $value;
    }

    /**
     * Gets the DateTime the role was created.
     *
     * @return DateTime A DateTime object.
     */
    public function getCreatedAt() {
        return $this->createdAt;
    }

    /**
     * Consturcts a new instance of Role.
     */
    public function __construct() {
        $this->createdAt = new \DateTime();
        $this->groupRole = new ArrayCollection();
    }

    /**
     * Implementation of getRole for the RoleInterface.
     *
     * @return string The role.
     */
    public function getRole() {
        $roles = array();
        foreach ($this->groupRole as $role) {
            $roles[] = $role->getRole();
        }
        return $roles;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return Role
     */
    public function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Add groupRole
     *
     * @param \Kaan\AppBundle\Entity\Role $groupRole
     * @return Group
     */
    public function addGroupRole(\Kaan\UserBundle\Entity\Role $groupRole)
    {
        $this->groupRole[] = $groupRole;

        return $this;
    }

    /**
     * Remove groupRole
     *
     * @param \Kaan\AppBundle\Entity\Role $groupRole
     */
    public function removeGroupRole(\Kaan\UserBundle\Entity\Role $groupRole)
    {
        $this->groupRole->removeElement($groupRole);
    }

    /**
     * Get groupRole
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGroupRole()
    {
        return $this->groupRole;
    }
}