<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class ClientService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="Admin\Entity\ClientEntity";
        parent::__construct($em);
    }
}