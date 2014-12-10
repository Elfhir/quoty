<?php
// src/Quoty/UserBundle/DataFixtures/ORM/LoadUser.php

namespace Quoty\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;

use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\DependencyInjection\ContainerAware;
use FOS\UserBundle\Model\UserManager;
use Quoty\UserBundle\Entity\User;


class LoadUser extends ContainerAware implements FixtureInterface
{
	// EntityManager is loaded
	public function load(ObjectManager $manager)
	{
		// List of Categories
		$listUsers = array(
			array(
				'name' => 'Elsa',
				'plainPassword' => 'letitgo',
				'email'=> 'elsa@arendelle.dk',
				'enable' => true
			),
			array(
				'name' => 'Anna',
				'plainPassword' => 'snowman',
				'email'  => 'anna@arendelle.dk',
				'enable' => true
			)
		);

		// Load userManager from FOSUserBundle, usefull for password, canonical ...
		$userManager = $this->container->get('fos_user.user_manager');

		
		foreach ($listUsers as $list) {

			$user = new User();

			// Plain password is not encrypted, but it will not be persisted
			// Instead, password will be encrypt with bcrypt
			$user->setPlainPassword($list['plainPassword']);

			$user->setUsername($list['name']);
			$user->setEmail($list['email']);
			$user->setEnabled($list['enable']);

			$user->setRoles(array('ROLE_USER'));
			
			// We have to use FOS userManager because it will encrypt the password ;
			// see security.yml
			$userManager->updateUser($user, false);
		}

		// Register the categories (execute dql/sql)
		$manager->flush();
	}


}