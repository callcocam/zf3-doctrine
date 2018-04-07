<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;
use ControlDeEstoque\Entity\CategoriaEntity;
use ControlDeEstoque\Entity\MarcaEntity;

class ProdutoService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="ControlDeEstoque\Entity\ProdutoEntity";
        parent::__construct($em);
    }

    public function save( Array $data = [] )
    {
        $data['brand'] = $this->em->getReference(MarcaEntity::class, $data['brand']);
        $data['categorie'] = $this->em->getReference(CategoriaEntity::class, $data['categorie']);
        //$data['author'] = $this->em->getReference(UserEntity::class, $data['author']);
        return parent::save($data);
    }
}