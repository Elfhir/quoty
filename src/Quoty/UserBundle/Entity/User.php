<?php

namespace Quoty\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Quoty\UserBundle\Entity\UserRepository")
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

   	/**
	 * @var string
	 *
	 * @ORM\Column(name="username", type="string", length=255, unique=true)
	 */
	protected $username;

	/**
	 * @ORM\Column(name="password", type="string", length=255)
	 */
	protected $password;

	/**
	 * @ORM\Column(name="salt", type="string", length=255)
	 */
	protected $salt;

	/**
	 * @ORM\Column(name="roles", type="array")
	 */
	protected $roles = array();

	/**
	 * Set username
	 *
	 * @param string $username
	 * @return User
	 */
	public function setUsername($username)
	{
		$this->username = $username;

		return $this;
	}

	/**
	 * Get username
	 *
	 * @return string 
	 */
	public function getUsername()
	{
		return $this->username;
	}
}
