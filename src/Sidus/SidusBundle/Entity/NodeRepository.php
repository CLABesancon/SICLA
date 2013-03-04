<?php

namespace Sidus\SidusBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * NodeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NodeRepository extends EntityRepository
{
    public function getAscendants($node,$version){
        $version_node = $version->getNode();
        $version_object = $version->getObject();
        
        $qb = $this->createQueryBuilder('n')
                ->leftJoin('n.versions', 'v')
                ->addSelect('v')
                ->leftJoin('v.object', 'o')
                ->addSelect('o')
                ->andWhere('n.id = :node')
                ->andWhere('v.node = :version_n')
                ->andWhere('v.object = :version_o')
                ->setParameter('version_n', $version_node)
                ->setParameter('version_o', $version_object)
                ->setParameter('node', $node);
        return $qb->getQuery()->getResult();
    }
}
