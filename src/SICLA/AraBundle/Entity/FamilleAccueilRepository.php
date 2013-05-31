<?php

namespace SICLA\AraBundle\Entity;
use Doctrine\ORM\EntityRepository;

/**
 * FamilleAccueilRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FamilleAccueilRepository extends EntityRepository
{
		public function findFamillesDispos($date_arrivee, $date_depart)
	{
	  $qb = $this->_em->createQueryBuilder();

	  $qb->select('f')
		 ->from('SICLAAraBundle:FamilleAccueil', 'f')
		 ->where('f.debutDispo < :dateArrivee')
		 ->andWhere('f.finDispo > :dateDepart')
		 ->setParameter('dateArrivee', $date_arrivee)
		 ->setParameter('dateDepart', $date_depart);
		return $qb->getQuery()
				  ->getResult();
	}
		public function getNbAffectations($id, $date_arrivee, $date_depart){
			 $qb = $this->_em->createQueryBuilder();

		 $qb->select('COUNT(f)')
		 ->from('SICLAAraBundle:AffectationDemande', 'f')
		 ->where('f.famille = :id ')
		 ->andWhere('f.dateArrivee > :dateArrivee')
		 ->andWhere('f.dateDepart < :dateDepart')
		 ->setParameter('id', $id)		 
		 ->setParameter('dateArrivee', $date_arrivee)
		 ->setParameter('dateDepart', $date_depart);
		return $qb->getQuery()
				  ->getResult();	  
		}
}
