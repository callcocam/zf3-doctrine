<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace S_Demo\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class S_NameService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="S_Demo\Entity\S_NameEntity";
        parent::__construct($em);
    }
}