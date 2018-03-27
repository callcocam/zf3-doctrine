<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class EmpresaService extends AbstractService
{

    /**
     * NameService constructor.
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->entity="Admin\Entity\EmpresaEntity";
        parent::__construct($em);
    }

    public function createEmpresafNotExists()
    {
        if (!$this->em->getRepository($this->entity)->findOneBy([])) {
            $user['email'] = 'contato@sigasmart.com.br';
            $user['first_name'] = 'Administrador';
            $user['last_name'] = 'Sistema';
            $user['status'] = '1';
            $passwordHash = $this->encryptPassword($user['email'], 'Security');
            $user['password'] = $passwordHash;
            $user['created_at'] = date('Y-m-d');
            $user['updated_at'] = date('Y-m-d H:i:s');
            return parent::save($user);
        }
    }
}