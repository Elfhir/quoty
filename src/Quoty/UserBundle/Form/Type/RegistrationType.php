<?php

// src/Quoty/UserBundle/Form/Type/RegistrationType.php
namespace Quoty\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Quoty\UserBundle\Form\UserType;

class RegistrationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder->add('user', new UserType());
		$builder->add('terms', 'checkbox', array('property_path' => 'termsAccepted'));
	}

	public function getName()
	{
		return 'registration';
	}
}


?>