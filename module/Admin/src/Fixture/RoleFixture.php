<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/04/2018
 * Time: 17:58
 */

namespace Admin\Service;


use Admin\Entity\RoleEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RoleFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {
        $role = new RoleEntity();
        $role->setEmpresa($this->getReference("empresa-01"))
            ->setName('Visitante')
            ->setAlias('visitante')
            ->setParent(null)
            ->setIsAdmin(0)
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($role);
        $this->addReference("role-07", $role);
        $manager->flush();

        $role = new RoleEntity();
        $role->setEmpresa($this->getReference("empresa-01"))
            ->setName('Usuarios(Site)')
            ->setAlias('usuarios-site')
            ->setParent($this->getReference('role-07')->getId())
            ->setIsAdmin(0)
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($role);
        $this->addReference("role-06", $role);
        $manager->flush();

        $role = new RoleEntity();
        $role->setEmpresa($this->getReference("empresa-01"))
            ->setName('Usuarios(Admin)')
            ->setAlias('usuarios-admin')
            ->setParent($this->getReference('role-06')->getId())
            ->setIsAdmin(0)
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($role);
        $this->addReference("role-05", $role);
        $manager->flush();

        $role = new RoleEntity();
        $role->setEmpresa($this->getReference("empresa-01"))
            ->setName('Gerente Geral(Admin)')
            ->setAlias('gerente-geral-admin')
            ->setParent($this->getReference('role-05')->getId())
            ->setIsAdmin(0)
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($role);
        $this->addReference("role-04", $role);
        $manager->flush();

        $role = new RoleEntity();
        $role->setEmpresa($this->getReference("empresa-01"))
            ->setName('Assistente (Admin)')
            ->setAlias('assistente-admin')
            ->setParent($this->getReference('role-04')->getId())
            ->setIsAdmin(0)
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($role);
        $this->addReference("role-03", $role);
        $manager->flush();

        $role = new RoleEntity();
        $role->setEmpresa($this->getReference("empresa-01"))
            ->setName('Administrador do sistema')
            ->setAlias('administrador-do-sistema')
            ->setParent($this->getReference('role-03')->getId())
            ->setIsAdmin(0)
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($role);
        $this->addReference("role-02", $role);
        $manager->flush();

        $role = new RoleEntity();
        $role->setEmpresa($this->getReference("empresa-01"))
            ->setName('Super Admin')
            ->setAlias('super-admin')
            ->setParent($this->getReference('role-02')->getId())
            ->setIsAdmin(1)
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($role);
        $this->addReference("role-01", $role);
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 20;
    }
}