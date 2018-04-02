<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Agenda\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class CategorieService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="Agenda\Entity\CategorieEntity";
        parent::__construct($em);
    }
}