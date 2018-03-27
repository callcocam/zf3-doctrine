<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 23/03/2018
 * Time: 09:20
 */

namespace Auth\Service;


use Core\Service\AbstractService;
use Doctrine\ORM\EntityManager;

class AuthService extends AbstractService
{
    public function __construct(EntityManager $em)
    {
        $this->entity = "Admin\\Entity\\UserEntity";
        parent::__construct($em);
    }

    public function createAdminUserIfNotExists()
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