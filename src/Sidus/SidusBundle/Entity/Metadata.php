<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Metadata
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Sidus\SidusBundle\Entity\MetadataRepository")
 */
class Metadata extends Object {

	/**
	 * @var integer
	 *
	 * @ORM\Column(name="id_object", type="integer")
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	private $id;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="title", type="string", length=255)
	 */
	private $title;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="content", type="blob")
	 */
	private $content;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="tags", type="blob")
	 */
	private $tags;

	/**
	 * Get id
	 *
	 * @return integer 
	 */
	public function getId() {
		return $this->id;
	}

	/**
	 * Set title
	 *
	 * @param string $title
	 * @return Metadata
	 */
	public function setTitle($title) {
		$this->title = $title;

		return $this;
	}

	/**
	 * Get title
	 *
	 * @return string 
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Set content
	 *
	 * @param string $content
	 * @return Metadata
	 */
	public function setContent($content) {
		$this->content = $content;

		return $this;
	}

	/**
	 * Get content
	 *
	 * @return string 
	 */
	public function getContent() {
		return $this->content;
	}

	/**
	 * Set tags
	 *
	 * @param string $tags
	 * @return Metadata
	 */
	public function setTags($tags) {
		$this->tags = $tags;

		return $this;
	}

	/**
	 * Get tags
	 *
	 * @return string 
	 */
	public function getTags() {
		return $this->tags;
	}

}