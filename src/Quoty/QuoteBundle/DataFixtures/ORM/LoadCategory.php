<?php
// src/Quoty/QuoteBundle/DataFixtures/ORM/LoadCategory.php

namespace Quoty\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Quoty\QuoteBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{
	// EntityManager is loaded
	public function load(ObjectManager $manager)
	{
		// List of Categories
		$names = array(
			'Militaire',
			'Sportif',
			'Artistique',
			'Cinéma',
			'Essayiste',
			'Inconnu'
		);

		foreach ($names as $name) {

			$category = new Category();
			$category->setName($name);

			// convert object to dql
			$manager->persist($category);
		}

		// Register the categories (execute dql/sql)
		$manager->flush();
	}
}