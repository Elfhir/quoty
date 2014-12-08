<?php

//src/Quoty/QuoteBundle/Services/CategoryIntegrity.php

namespace Quoty\QuoteBundle\Services;

use Doctrine\ORM\EntityRepository;


class CategoryIntegrity
{

	/**
	 * Get All categories value in Table Quote
	 * @return [array] [array of categories, or null]
	 */
	public function findAllCategories()
	{
		$queryBuilder = $this->_em->createQueryBuilder()
			->select('a')
			->from($this->_entityName, 'a');

		$query = $queryBuilder->getQuery();
		$results = $query->getResults();
		return $results;
	}


	public function categoryExists($category)
	{
		$categories = $this->findAllCategories();

		return in_array($category->name, $categories);
	}

}


?>