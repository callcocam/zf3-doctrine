<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * ResourceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResourceRepository extends EntityRepository
{

    public function findByAll()
    {
        $sql = $this->createQueryBuilder('genus');
        $sql->where($sql->expr()->eq('genus.status',1));
        return $sql->getQuery()->getResult();
    }
}
