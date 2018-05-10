<?php
/**
 * Created by PhpStorm.
 * User: Salao Do Reino
 * Date: 02/05/2018
 * Time: 16:35
 */

namespace Home\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class RegisterService extends AbstractService
{

    public function __construct(EntityManager $em)
    {
        $this->entity = "Sisc\\Entity\\ClientEntity";
        parent::__construct($em);
    }

}