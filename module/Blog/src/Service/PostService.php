<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Blog\Service;


use Blog\Entity\CategorieBlogEntity;
use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class PostService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="Blog\Entity\PostEntity";
        parent::__construct($em);
    }

    public function save( Array $data = [] )
    {
        $data['categorie'] = $this->em->getReference(CategorieBlogEntity::class,$data['categorie']);
        return parent::save($data); // TODO: Change the autogenerated stub
    }
}