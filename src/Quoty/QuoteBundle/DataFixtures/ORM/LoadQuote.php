<?php
// src/Quoty/QuoteBundle/DataFixtures/ORM/LoadQuote.php

namespace Quoty\PlatformBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Quoty\QuoteBundle\Entity\Quote;
use Quoty\QuoteBundle\Entity\Category;

class LoadQuote implements FixtureInterface, OrderedFixtureInterface
{
	// EntityManager is loaded
	public function load(ObjectManager $manager)
	{
		// List of Categories
		$quotes = array(
			array(
				'content' => 'On ne vend pas la musique. On la partage.',
				'author' => 'Léonard Bernstein',
				'category' => new Category('Musique')
			),
			array(
				'content' => 'Le seul véritable commentaire d\'un morceau de musique est un autre morceau de musique.',
				'author' => 'Matthew Gregory Lewis',
				'category' => new Category('Musique')
			),
			array(
				'content' => 'La musique est une révélation plus haute que toute sagesse et toute philosophie.',
				'author' => 'Ludwig Van Beethoven',
				'category' => new Category('Musique')
			),
			array(
				'content' => 'La musique est la langue des émotions.',
				'author' => 'Emanuel Kant',
				'category' => new Category('Philosophie')
			),
			array(
				'content' => 'Si l’État est fort, il nous écrase. S’il est faible, nous périssons.',
				'author' => 'Paul Valéry',
				'category' => new Category('Politique')
			),
			array(
				'content' => 'Les conneries c\'est comme les impôts, on finit toujours par les payer.',
				'author' => 'Michel Audiard',
				'category' => new Category('Politique')
			)
		);



		foreach ($quotes as $q) {

			$quote = new Quote();
			$quote->setAuthor($q['author']);
			$quote->setContent($q['content']);
			$quote->addCategory($q['category']);

			// convert object to dql
			$manager->persist($quote);
		}

		// Register the categories (execute dql/sql)
		$manager->flush();
	}

	/**
	 * {@inheritDoc}
	 */
	public function getOrder()
	{
		return 1; // l'ordre dans lequel les fichiers sont chargés
	}
}