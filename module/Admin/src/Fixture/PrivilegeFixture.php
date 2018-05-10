<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/04/2018
 * Time: 21:42
 */

namespace Admin\Service;


use Admin\Entity\PrivilegeEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PrivilegeFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {

        $Entity = new PrivilegeEntity();
        $Entity->setName("Dash-Board")
            ->setController('Admin\Controller\Admin')
            ->setParent("state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form,delete")
            ->setRole($this->getReference('role-06')->getId())
            ->setResource($this->getReference('resource-01'))
            ->setEmpresa($this->getReference("empresa-01"))
            ->setStatus("1")
            ->setAction("ver")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($Entity);

        $Entity = new PrivilegeEntity();
        $Entity->setName("Admin-Config")
            ->setController('Admin\Controller\Config')
            ->setParent("state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form,delete")
            ->setRole($this->getReference('role-03')->getId())
            ->setResource($this->getReference('resource-01'))
            ->setEmpresa($this->getReference("empresa-01"))
            ->setStatus("1")
            ->setAction("ver")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($Entity);

        $Entity = new PrivilegeEntity();
        $Entity->setName("Admin-User")
            ->setController('Admin\Controller\User')
            ->setParent("state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form,delete")
            ->setRole($this->getReference('role-03')->getId())
            ->setResource($this->getReference('resource-01'))
            ->setEmpresa($this->getReference("empresa-01"))
            ->setStatus("1")
            ->setAction("ver")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($Entity);

        $Entity = new PrivilegeEntity();
        $Entity->setName("Admin-Empresa")
            ->setController('Admin\Controller\Empresa')
            ->setParent("state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form,delete")
            ->setRole($this->getReference('role-06')->getId())
            ->setResource($this->getReference('resource-01'))
            ->setEmpresa($this->getReference("empresa-01"))
            ->setStatus("1")
            ->setAction("ver")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($Entity);


        $Entity = new PrivilegeEntity();
        $Entity->setName("eSic")
            ->setController('Sisc\Controller\Sisc')
            ->setParent("state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form,delete")
            ->setRole($this->getReference('role-06')->getId())
            ->setResource($this->getReference('resource-02'))
            ->setEmpresa($this->getReference("empresa-02"))
            ->setStatus("1")
            ->setAction("ver")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($Entity);

        $Entity = new PrivilegeEntity();
        $Entity->setName("eSic-Solicitações")
            ->setController('Sisc\Controller\Solicitacoe')
            ->setParent("state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form,delete")
            ->setRole($this->getReference('role-06')->getId())
            ->setResource($this->getReference('resource-02'))
            ->setEmpresa($this->getReference("empresa-02"))
            ->setStatus("1")
            ->setAction("ver")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($Entity);

        $Entity = new PrivilegeEntity();
        $Entity->setName("eSic-Clientes")
            ->setController('Sisc\Controller\Client')
            ->setParent("state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form,delete")
            ->setRole($this->getReference('role-06')->getId())
            ->setResource($this->getReference('resource-02'))
            ->setEmpresa($this->getReference("empresa-02"))
            ->setStatus("1")
            ->setAction("ver")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($Entity);



        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 27;
    }
}