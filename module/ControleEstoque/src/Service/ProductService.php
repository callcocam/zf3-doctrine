<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace ControleEstoque\Service;


use Admin\Entity\UserEntity;
use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class ProductService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct( EntityManager $em )
    {
        $this->entity = "ControleEstoque\Entity\ProductEntity";
        parent::__construct($em);
    }

    public function save( Array $data = [] )
    {
        $data['author'] = $this->em->getReference(UserEntity::class, $data['author']);
        return parent::save($data); // TODO: Change the autogenerated stub
    }
}