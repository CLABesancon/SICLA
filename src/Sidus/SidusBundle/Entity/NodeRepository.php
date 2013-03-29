<?php

namespace Sidus\SidusBundle\Entity;

use Gedmo\Tree\Entity\Repository\NestedTreeRepository;
use Gedmo\Tool\Wrapper\EntityWrapper;
use Doctrine\ORM\Query,
	Gedmo\Tree\Strategy,
	Gedmo\Tree\Strategy\ORM\Nested,
	Gedmo\Exception\InvalidArgumentException,
	Gedmo\Exception\UnexpectedValueException,
	Doctrine\ORM\Proxy\Proxy;

/**
 * NodeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NodeRepository extends NestedTreeRepository {


	/**
	 * Récupère la node avec la node User Created By et la node user Modified By
	 * @param integer $node_id
	 */
	public function getNodeWithCreatedByAndModifiedBy($node_id){
		$qb=$this->createQueryBuilder('n');
	}

	/**
	 * Get the Tree path query builder by given $node
	 *
	 * @param object $node
	 * @throws InvalidArgumentException - if input is not valid
	 * @return Doctrine\ORM\QueryBuilder
	 */
	public function getPathQueryBuilder($node) {
		$meta = $this->getClassMetadata();
		if (!$node instanceof $meta->name) {
			throw new InvalidArgumentException("Node is not related to this repository");
		}
		$config = $this->listener->getConfiguration($this->_em, $meta->name);
		$wrapped = new EntityWrapper($node, $this->_em);
		if (!$wrapped->hasValidIdentifier()) {
			throw new InvalidArgumentException("Node is not managed by UnitOfWork");
		}
		$left = $wrapped->getPropertyValue($config['left']);
		$right = $wrapped->getPropertyValue($config['right']);
		$qb = $this->_em->createQueryBuilder();
		$qb->select('node')
				->from($config['useObjectClass'], 'node')
				->where($qb->expr()->lte('node.' . $config['left'], $left))
				->andWhere($qb->expr()->gte('node.' . $config['right'], $right))
				->orderBy('node.' . $config['left'], 'ASC')
		;
		if (isset($config['root'])) {
			$rootId = $wrapped->getPropertyValue($config['root']);
			$qb->andWhere($rootId === null ?
							$qb->expr()->isNull('node.' . $config['root']) :
							$qb->expr()->eq('node.' . $config['root'], is_string($rootId) ? $qb->expr()->literal($rootId) : $rootId)
			);
		}
		return $qb;
	}

	/**
	 * @see getChildrenQueryBuilder
	 */
	public function childrenQueryBuilder($node = null, $direct = false, $sortByField = null, $direction = 'ASC', $includeNode = false) {
		$meta = $this->getClassMetadata();
		$config = $this->listener->getConfiguration($this->_em, $meta->name);

		$qb = $this->_em->createQueryBuilder();
		$qb->select('node')
				->from($config['useObjectClass'], 'node')
		;
		if ($node !== null) {
			if ($node instanceof $meta->name) {
				$wrapped = new EntityWrapper($node, $this->_em);
				if (!$wrapped->hasValidIdentifier()) {
					throw new InvalidArgumentException("Node is not managed by UnitOfWork");
				}
				if ($direct) {
					$id = $wrapped->getIdentifier();
					$qb->where($id === null ?
									$qb->expr()->isNull('node.' . $config['parent']) :
									$qb->expr()->eq('node.' . $config['parent'], is_string($id) ? $qb->expr()->literal($id) : $id)
					);
				} else {
					$left = $wrapped->getPropertyValue($config['left']);
					$right = $wrapped->getPropertyValue($config['right']);
					if ($left && $right) {
						$qb
								->where($qb->expr()->lt('node.' . $config['right'], $right))
								->andWhere($qb->expr()->gt('node.' . $config['left'], $left))
						;
					}
				}
				if (isset($config['root'])) {
					$rootId = $wrapped->getPropertyValue($config['root']);
					$qb->andWhere($rootId === null ?
									$qb->expr()->isNull('node.' . $config['root']) :
									$qb->expr()->eq('node.' . $config['root'], is_string($rootId) ? $qb->expr()->literal($rootId) : $rootId)
					);
				}
				if ($includeNode) {
					$idField = $meta->getSingleIdentifierFieldName();
					$qb->where('(' . $qb->getDqlPart('where') . ') OR node.' . $idField . ' = :rootNode');
					$qb->setParameter('rootNode', $node);
				}
			} else {
				throw new \InvalidArgumentException("Node is not related to this repository");
			}
		} else {
			if ($direct) {
				$qb->where($qb->expr()->isNull('node.' . $config['parent']));
			}
		}
		if (!$sortByField) {
			$qb->orderBy('node.' . $config['left'], 'ASC');
		} elseif (is_array($sortByField)) {
			$fields = '';
			foreach ($sortByField as $field) {
				$fields .= 'node.' . $field . ',';
			}
			$fields = rtrim($fields, ',');
			$qb->orderBy($fields, $direction);
		} else {
			if ($meta->hasField($sortByField) && in_array(strtolower($direction), array('asc', 'desc'))) {
				$qb->orderBy('node.' . $sortByField, $direction);
			} else {
				throw new InvalidArgumentException("Invalid sort options specified: field - {$sortByField}, direction - {$direction}");
			}
		}
		return $qb;
	}


}
