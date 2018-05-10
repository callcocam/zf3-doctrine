<?php
/**
 * Created by PhpStorm.
 * User: Salao Do Reino
 * Date: 08/05/2018
 * Time: 09:48
 */

namespace Admin\View\Helper;


use Doctrine\ORM\EntityRepository;
use Zend\View\Helper\AbstractHelper;

class AdminVisitHelper extends AbstractHelper
{
    /**
     * @var EntityRepository
     */
    private $repository;
    private $id;

    /**
     * AdminHelper constructor.
     * @param EntityRepository $repository
     */
    public function __construct(EntityRepository $repository,$id)
    {

        $this->repository = $repository;
        $this->id = $id;
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function getTotalVisit(){
        return $this->repository->getTotalVisit($this->id);
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function getMonth(){

        return $this->repository->getTotalVisitMonth($this->id);
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function getDay(){

        return $this->repository->getTotalVisitDay($this->id);
    }

    /**
     * @return mixed
     * @throws \Doctrine\ORM\ORMException
     */
    public function getYear(){

        return $this->repository->getTotalVisitYear($this->id);
    }

}