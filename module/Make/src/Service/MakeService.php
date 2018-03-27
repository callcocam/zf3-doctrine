<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 16:04
 */

namespace Make\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class MakeService extends AbstractService
{

    /**
     * EmpresaService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="Make\Entity\MakeEntity";
        parent::__construct($em);
    }
}