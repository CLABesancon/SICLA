<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Page
 *
 * @ORM\Table(name="folder")
 * @ORM\Entity(repositoryClass="Sidus\SidusBundle\Entity\FolderRepository")
 */
class Folder extends Object {

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
	 * @ORM\Column(name="content", type="text")
	 */
	private $content;

	/**
	 * @var string
	 *
	 * @ORM\Column(name="tags", type="text")
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