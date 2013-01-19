<?php

namespace Kaan\UserBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 */
class User implements UserInterface {

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     * @var integer $id
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=255,unique=TRUE)
     * @var string $email
     */
    protected $email;

    /**
     * @ORM\Column(type="datetime", name="created_at")
     * @Gedmo\Timestampable(on="create")
     * @var DateTime $createdAt
     */
    protected $createdAt;

    /**
     * @ORM\Column(type="string", length=255,unique=TRUE)
     * @var string username
     */
    protected $username;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string password
     */
    protected $password;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @var string salt
     */
    protected $salt;

    /**
     * @ORM\ManyToMany(targetEntity="Role")
     * @ORM\JoinTable(name="user_role",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="role_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection $userRoles
     */
    protected $userRoles;

    /**
     * @ORM\ManyToMany(targetEntity="Group")
     * @ORM\JoinTable(name="user_group",
     *     joinColumns={@ORM\JoinColumn(name="user_id", referencedColumnName="id")},
     *     inverseJoinColumns={@ORM\JoinColumn(name="group_id", referencedColumnName="id")}
     * )
     *
     * @var ArrayCollection $userGroup
     */
    protected $userGroup;

    /**
     * Gets the username.
     *
     * @return string The username.
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * Sets the username.
     *
     * @param string $value The username.
     */
    public function setUsername($value) {
        $this->username = $value;
    }

    /**
     * Gets the user password.
     *
     * @return string The password.
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Sets the user password.
     *
     * @param string $value The password.
     */
    public function setPassword($value) {
        $this->password = $value;
    }

    /**
     * Gets the user salt.
     *
     * @return string The salt.
     */
    public function getSalt() {
        return $this->salt;
    }

    /**
     * Sets the user salt.
     *
     * @param string $value The salt.
     */
    public function setSalt($value) {
        $this->salt = $value;
    }

    /**
     * Gets the user roles.
     *
     * @return ArrayCollection A Doctrine ArrayCollection
     */
    public function getUserRoles() {
        return $this->userRoles;
    }

    /**
     * Constructs a new instance of User
     */
    public function __construct() {
        $this->userRoles = new ArrayCollection();
        $this->userGroup = new ArrayCollection();
    }

    /**
     * Erases the user credentials.
     */
    public function eraseCredentials() {

    }

    /**
     * Gets an array of roles.
     *
     * @return array An array of Role objects
     */
    public function getRoles() {
        $roles = array();
        $grouprole = array();
        foreach ($this->userRoles as $role) {
            $roles[] = $role->getRole();
        }
        foreach ($this->userGroup as $row) {
            $grouprole = $row->getRole();
        }

        return array_merge($roles,$grouprole);
    }

    /**
     * Compares this user to another to determine if they are the same.
     *
     * @param UserInterface $user The user
     * @return boolean True if equal, false othwerwise.
     */
    public function equals(UserInterface $user) {
        return md5($this->getUsername()) == md5($user->getUsername());
    }

    public function __toString() {
        return $this->username . '-' . $this->email;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }


    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email) {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return User
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
     * Add userRoles
     *
     * @param \Kaan\UserBundle\Entity\Role $userRoles
     * @return User
     */
    public function addUserRole(\Kaan\UserBundle\Entity\Role $userRoles) {
        $this->userRoles[] = $userRoles;

        return $this;
    }

    /**
     * Remove userRoles
     * 
     * @param \Kaan\UserBundle\Entity\Role $userRoles
     */
    public function removeUserRole(\Kaan\UserBundle\Entity\Role $userRoles) {
        $this->userRoles->removeElement($userRoles);
    }

    /**
     * Add userGroup
     *
     * @param \Kaan\AppBundle\Entity\Group $userGroup
     * @return User
     */
    public function addUserGroup(\Kaan\UserBundle\Entity\Group $userGroup) {
        $this->userGroup[] = $userGroup;

        return $this;
    }

    /**
     * Remove userGroup
     *
     * @param \Kaan\UserBundle\Entity\Group $userGroup
     */
    public function removeUserGroup(\Kaan\UserBundle\Entity\Group $userGroup) {
        $this->userGroup->removeElement($userGroup);
    }

    /**
     * Get userGroup
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUserGroup() {
        return $this->userGroup;
    }


}