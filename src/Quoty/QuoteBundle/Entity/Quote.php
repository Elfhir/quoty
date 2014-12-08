<?php

namespace Quoty\QuoteBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

/**
 * Quote
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Quoty\QuoteBundle\Entity\QuoteRepository")
 */
class Quote
{

	/**
	 * categories is another entity/object, so ArrayCollection;
	 */
	public function __construct()
	{
		$this->lastUpdate = new \Datetime();
		$this->categories = new ArrayCollection();
	}

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var \DateTime
	 *
	 * @ORM\Column(name="lastUpdate", type="datetime")
	 */
	private $lastUpdate;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="content", type="text")
	 */
	private $content;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="author", type="string", length=255, unique=true)
	 */
	private $author;

	/**
	* @ORM\ManyToMany(targetEntity="Quoty\QuoteBundle\Entity\Category", cascade={"persist"})
	*/
	private $categories;


	public function addCategory(Category $category)
	{
		$this->categories[] = $category;

		return $this;
	}

	public function removeCategory(Category $category)
	{
		$this->categories->removeElement($category);
	}

	public function getCategories()
	{
		return $this->categories;
	}

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * Set lastUpdate
	 *
	 * @param \DateTime $lastUpdate
	 * @return Quote
	 */
	public function setLastUpdate($lastUpdate)
	{
		$this->lastUpdate = $lastUpdate;

		return $this;
	}

	/**
	 * Get lastUpdate
	 *
	 * @return \DateTime 
	 */
	public function getLastUpdate()
	{
		return $this->lastUpdate;
	}

	/**
	 * Set content
	 *
	 * @param string $content
	 * @return Quote
	 */
	public function setContent($content)
	{
		$this->content = $content;

		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string 
	 */
	public function getContent()
	{
		return $this->content;
	}

	/**
	 * Set author
	 *
	 * @param string $author
	 * @return Quote
	 */
	public function setAuthor($author)
	{
		$this->author = $author;

		return $this;
	}

	/**
	 * Get author
	 *
	 * @return string 
	 */
	public function getAuthor()
	{
		return $this->author;
	}
}
