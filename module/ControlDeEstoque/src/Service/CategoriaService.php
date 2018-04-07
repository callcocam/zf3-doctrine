<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class CategoriaService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="ControlDeEstoque\Entity\CategoriaEntity";
        parent::__construct($em);
    }
}