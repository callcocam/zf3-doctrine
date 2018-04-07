<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Blog\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class CategorieBlogService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="Blog\Entity\CategorieBlogEntity";
        parent::__construct($em);
    }
}