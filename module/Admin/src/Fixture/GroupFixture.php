<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Fixture;


use Admin\Entity\GroupEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class GroupFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {
        $group = new GroupEntity();
        $group->setEmpresa($this->getReference("empresa-01"));
        $group->setName("Operacional")
            ->setAlias("Admin\Controller\Admin")
            ->setRoute($this->getReference('resource-01'))
            ->setRole($this->getReference('role-02'))
            ->setController("admin")
            ->setAction("index")
            ->setIcone("fa fa-gears")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo principal do sistema")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($group);
        $this->addReference("group-01", $group);

        $group = new GroupEntity();
        $group->setEmpresa($this->getReference("empresa-01"));
        $group->setName("Agenda")
            ->setAlias("Agenda\Controller\Agenda")
            ->setRoute($this->getReference('resource-02'))
            ->setRole($this->getReference('role-02'))
            ->setController("agenda")
            ->setAction("index")
            ->setIcone("fa fa-book")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo principal da agenda")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($group);
        $this->addReference("group-02", $group);

        $group = new GroupEntity();
        $group->setEmpresa($this->getReference("empresa-01"));
        $group->setName("Banners")
            ->setAlias("Banner\Controller\Banner")
            ->setRoute($this->getReference('resource-03'))
            ->setRole($this->getReference('role-02'))
            ->setController("banner")
            ->setAction("index")
            ->setIcone("fa fa-image")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo banner")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($group);
        $this->addReference("group-03", $group);

        $group = new GroupEntity();
        $group->setEmpresa($this->getReference("empresa-01"));
        $group->setName("Blog")
            ->setAlias("Blog\Controller\Blog")
            ->setRoute($this->getReference('resource-04'))
            ->setRole($this->getReference('role-02'))
            ->setController("blog")
            ->setAction("index")
            ->setIcone("fa fa-commenting-o")
            ->setOrdem(1)
            ->setStatus(1)
            ->setDescription("Modulo blog")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($group);
        $this->addReference("group-04", $group);
        $manager->flush();



    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 23;
    }
}