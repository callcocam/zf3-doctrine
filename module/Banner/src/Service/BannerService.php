<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Banner\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class BannerService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="Banner\Entity\BannerEntity";
        parent::__construct($em);
    }
}