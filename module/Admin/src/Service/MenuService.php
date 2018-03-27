<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Service;


use Admin\Entity\EmpresaEntity;
use Admin\Entity\ResourceEntity;
use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class MenuService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="Admin\Entity\MenuEntity";
        parent::__construct($em);
    }

    public function save(Array $data = [])
    {
        $data['route'] = $this->em->getReference(ResourceEntity::class, $data['route']);
        if(!$data['parent']){
            $data['parent'] = null;
        }
        return parent::save($data);
    }

}