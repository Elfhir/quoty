<?php

// src/Quoty/UserBundle/Form/Model/Registration.php
namespace Quoty\UserBundle\Form\Model;

use Symfony\Component\Validator\Constraints as Assert;

use Quoty\UserBundle\Entity\User;

class Registration
{
	/**
	 * @Assert\Type(type="Quoty\UserBundle\Entity\User")
	 */
	protected $user;

	/**
	 * @Assert\NotBlank()
	 * @Assert\True()
	 */
	protected $termsAccepted;

	public function setUser(User $user)
	{
		$this->user = $user;
	}

	public function getUser()
	{
		return $this->user;
	}

	public function getTermsAccepted()
	{
		return $this->termsAccepted;
	}

	public function setTermsAccepted($termsAccepted)
	{
		$this->termsAccepted = (Boolean) $termsAccepted;
	}
}

?>