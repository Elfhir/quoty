<?php
// src/Quoty/UserBundle/DataFixtures/ORM/LoadUser.php

namespace Quoty\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Quoty\UserBundle\Entity\User;


class LoadUser implements FixtureInterface
{
	// EntityManager is loaded
	public function load(ObjectManager $manager)
	{
		// List of Categories
		$listUsers = array(
			array(
				'name' => 'Elsa',
				'password' => 'letitgo'
			),
			array(
				'name' => 'Anna',
				'password' => 'snowman'
			)
		);

		foreach ($listUsers as $list) {

			$user = new User();

			

			$user->setPassword($list['password']);
			$user->setUsername($list['name']);

			$user->setRoles(array('ROLE_USER'));
			// convert object to dql
			$manager->persist($user);
		}

		// Register the categories (execute dql/sql)
		$manager->flush();
	}
}