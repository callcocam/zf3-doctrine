<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/04/2018
 * Time: 22:17
 */

namespace Admin\Service;


use Admin\Entity\MenuEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class MenuFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load( ObjectManager $manager )
    {
        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Grupos")
            ->setAlias("Admin\Controller\Group")
            ->setRoute($this->getReference("resource-01"))
            ->setParent($this->getReference("group-01"))
            ->setController("group")
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo de menu principal")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Modulos")
            ->setAlias("Admin\Controller\Resource")
            ->setRoute($this->getReference("resource-01"))
            ->setParent($this->getReference("group-01"))
            ->setController("resource")
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo principal do sistema")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Controle\Acesso")
            ->setAlias("Admin\Controller\Role")
            ->setRoute($this->getReference("resource-01"))
            ->setParent($this->getReference("group-01"))
            ->setController("role")
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(2)
            ->setStatus(1)
            ->setDescription("Modulo de controle de acesso")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Privilegios")
            ->setAlias("Admin\Controller\Privilege")
            ->setParent($this->getReference("group-01"))
            ->setRoute($this->getReference("resource-01"))
            ->setController("privilege")
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo controle de privilégios do sistema")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Menus")
            ->setAlias("Admin\Controller\Menu")
            ->setController("menu")
            ->setParent($this->getReference("group-01"))
            ->setRoute($this->getReference("resource-01"))
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo principal do sistema")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Empresa")
            ->setAlias("Admin\Controller\Empresa")
            ->setController("empresa")
            ->setParent($this->getReference("group-01"))
            ->setRoute($this->getReference("resource-01"))
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo com os dados da empresa do sistema")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Usuarios")
            ->setAlias("Admin\Controller\User")
            ->setController("user")
            ->setParent($this->getReference("group-01"))
            ->setRoute($this->getReference("resource-01"))
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo principal do sistema")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Agenda")
            ->setAlias("Agenda\Controller\Evento")
            ->setController("evento")
            ->setParent($this->getReference("group-02"))
            ->setRoute($this->getReference("resource-02"))
            ->setRole($this->getReference('role-02'))
            ->setAction("compromissos")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo principal da agenda")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Posts")
            ->setAlias("Blog\Controller\Post")
            ->setController("post")
            ->setParent($this->getReference("group-04"))
            ->setRoute($this->getReference("resource-04"))
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Listar post")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $menu = new MenuEntity();
        $menu->setEmpresa($this->getReference("empresa-01"))
            ->setName("Categorias")
            ->setAlias("Blog\Controller\CategorieBlog")
            ->setController("categorie-blog")
            ->setParent($this->getReference("group-04"))
            ->setRoute($this->getReference("resource-04"))
            ->setRole($this->getReference('role-02'))
            ->setAction("index")
            ->setIcone("fa fa-angle-left pull-right")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Listar Categorias")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($menu);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 24;
    }
}