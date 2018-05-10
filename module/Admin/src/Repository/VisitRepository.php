<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Repository;


use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;

class VisitRepository extends EntityRepository
{

    public function getTotalVisit($id){
        /**
         * @var $Select QueryBuilder
         */
        $Select = $this->createQueryBuilder("p");
        $Select->where('p.empresa  = :empresa');
        $Select->setParameter('empresa', $id);
        $Select->select('COUNT(p.id) as total');
        return $Select->getQuery()->getSingleScalarResult();
    }

    public function getTotalVisitYear($id){
        /**
         * @var $Select QueryBuilder
         */
        $Select = $this->createQueryBuilder("p");
        $Select->where('p.empresa  = :empresa');
        $Select->andWhere($Select->expr()->eq('p.year',date("Y")));
        $Select->setParameter('empresa', $id);
        $Select->select('COUNT(p.id) as total');
        return $Select->getQuery()->getSingleScalarResult();
    }

    public function getTotalVisitMonth($id){
        // $month_count = cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y'));
        /**
         * @var $Select QueryBuilder
         */
        $Select = $this->createQueryBuilder("p");
        $Select->where('p.empresa  = :empresa');
        $Select->andWhere($Select->expr()->eq('p.month',date("m")));
        $Select->andWhere($Select->expr()->eq('p.year',date("Y")));
        $Select->setParameter('empresa', $id);
        $Select->select('COUNT(p.id) as total');
        return $Select->getQuery()->getSingleScalarResult();
    }



    public function getTotalVisitDay($id){
        /**
         * @var $Select QueryBuilder
         */
        $Select = $this->createQueryBuilder("p");
        $Select->where('p.empresa  = :empresa');
        $Select->andWhere($Select->expr()->eq('p.day',date("d")));
        $Select->andWhere($Select->expr()->eq('p.month',date("m")));
        $Select->andWhere($Select->expr()->eq('p.year',date("Y")));
        $Select->setParameter('empresa', $id);
        $Select->select('COUNT(p.id) as total');
        return $Select->getQuery()->getSingleScalarResult();
    }
}