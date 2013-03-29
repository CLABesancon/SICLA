<?php

namespace Sidus\SidusBundle\Services;

use Doctrine\Bundle\DoctrineBundle\Registry;
use Sidus\SidusBundle\Exceptions\NodeNotFoundException;

class NodeLoader {

	protected $doctrine;

	public function __construct(Registry $doctrine){
		$this->doctrine = $doctrine;
	}

	//TODO ? Not sure this is useful after all

}
