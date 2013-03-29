<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use \Symfony\Component\Security\Core\User\UserInterface;

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="Sidus\SidusBundle\Entity\UserRepository")
 */
class User extends Object implements UserInterface{

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id_object", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="username", type="string", length=255)
	 * @Assert\NotBlank()
	 */
	private $username;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="password", type="string", length=255)
	 * @Assert\NotBlank()
	 */
	private $password;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="salt", type="string", length=255)
	 * @Assert\NotBlank()
	 */
	private $salt;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=255)
	 * @Assert\NotBlank()
	 * @Assert\Email()
	 */
	private $email;


	/**
	 * @var \Datetime
	 *
	 * @ORM\Column(name="expire_at", type="datetime")
	 * @Assert\DateTime()
	 */
	private $expireAt;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="is_inactive", type="boolean")
	 */
	private $isInactive;

	public function __construct(){
		$this->isInactive = false;
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
	 * Set username
	 *
	 * @param string $username
	 * @return User
	 */
	public function setUsername($username) {
		$this->username = $username;

		return $this;
	}

	/**
	 * Get username
	 *
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * Set password
	 *
	 * @param string $password
	 * @return User
	 */
	public function setPassword($password) {
		$this->password = $password;

		return $this;
	}

	/**
	 * Get password
	 *
	 * @return string
	 */
	public function getPassword() {
		return $this->password;
	}

	/**
	 * Set salt
	 *
	 * @param string $salt
	 * @return User
	 */
	public function setSalt($salt) {
		$this->salt = $salt;

		return $this;
	}

	/**
	 * Get salt
	 *
	 * @return string
	 */
	public function getSalt() {
		return $this->salt;
	}


    /**
     * Set expireAt
     *
     * @param \DateTime $expireAt
     * @return User
     */
    public function setExpireAt($expireAt)
    {
        $this->expireAt = new \DateTime($expireAt);

        return $this;
    }

    /**
     * Get expireAt
     *
     * @return \DateTime
     */
    public function getExpireAt()
    {
        return $this->expireAt->format('Y-m-d H:i:s');
    }

    /**
     * Set isInactive
     *
     * @param boolean $isInactive
     * @return User
     */
    public function setIsInactive($isInactive)
    {
        $this->isInactive = $isInactive;

        return $this;
    }

    /**
     * Get isInactive
     *
     * @return boolean
     */
    public function getIsInactive()
    {
        return $this->isInactive;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

	public function eraseCredentials() {

	}

	public function getRoles() {

	}
}