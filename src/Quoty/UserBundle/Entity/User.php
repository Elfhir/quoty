<?php

namespace Quoty\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Quoty\UserBundle\Entity\UserRepository")
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 * @UniqueEntity("emailCanonical")
 * @UniqueEntity("usernameCanonical")
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
     * @var integer
     *
     * @ORM\Column(name="quoteNumber", type="integer")
     *
     * 
     */
    protected $quoteNumber;

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

	/**
     * Returns the user QuoteNumber
     * How many quote he can still post (it will
     * decreased )
     *
     * @return mixed
     */
    public function getQuoteNumber()
    {
        return $this->quoteNumber;
    }
	
	/**
     * Set the QuoteNumber
     *
     * @return mixed
     */
    public function setQuoteNumber($quoteNumber)
    {
    	$this->quoteNumber = (integer) $quoteNumber;

        return $this->quoteNumber;
    }

}
