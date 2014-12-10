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

	public function __construct()
	{
		$this->lastLogin = new \Datetime();
	}

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
	 * Username in lowercase
	 * @var string
	 *
	 * @ORM\Column(name="username_canonical", type="string", length=255, unique=true)
	 */
	protected $usernameCanonical;

	/**
	 * The email
	 * @var string
	 *
	 * @ORM\Column(name="email", type="string", length=255, unique=true)
	 */
	protected $email;

	/**
	 * Email in lowercase
	 * 
	 * @var string
	 *
	 * @ORM\Column(name="email_canonical", type="string", length=255, unique=true)
	 */
	protected $emailCanonical;

	/**
	 * @var boolean
	 *
	 * @ORM\Column(name="enable", type="boolean")
	 */
	protected $enabled;

	/**
	 * The salt to use for hashing
	 *
	 * @var string
	 *
	 * @ORM\Column(name="salt", type="text", nullable=false)
	 */
	protected $salt ="aetuosfhkmwcb";

	/**
	 * Encrypted password. Must be persisted.
	 *
	 * @var string
	 *
	 * @ORM\Column(name="password", type="text")
	 */
	protected $password;


	/**
	 * Plain password. Used for model validation. Must not be persisted.
	 * Plain means "text brut, non encrypté"
	 * @var string
	 *
	 */
	protected $plainPassword;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="lastLogin", type="datetime", nullable=true)
	 */
	protected $lastLogin;

	/**
	 * Random string sent to the user email address in order to verify it
	 *
	 * @var string
	 */
	protected $confirmationToken;


	/**
	 * @var array
	 *
	 * @ORM\Column(name="roles", type="array")
	 */
	protected $roles;


}
