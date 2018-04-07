<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class MarcaService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="ControlDeEstoque\Entity\MarcaEntity";
        parent::__construct($em);
    }
}