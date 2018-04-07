<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/04/2018
 * Time: 22:09
 */

namespace Admin\Service;


use Admin\Entity\ResourceEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class RosourceFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {
        $resource = new ResourceEntity();

        $resource->setEmpresa($this->getReference("empresa-01"));
        $resource->setName("Operacional")
            ->setAlias("Admin\Controller\Admin")
            ->setRoute("admin")
            ->setStatus(1)
            ->setDescription("Modulo principal do sistema")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($resource);
        $this->addReference("resource-01", $resource);

        $resource = new ResourceEntity();

        $resource->setEmpresa($this->getReference("empresa-01"));
        $resource->setName("Agenda")
            ->setAlias("Agenda\Controller\Agenda")
            ->setRoute("agenda")
            ->setStatus(1)
            ->setDescription("Modulo de agenda")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($resource);
        $this->addReference("resource-02", $resource);

        $resource = new ResourceEntity();

        $resource->setEmpresa($this->getReference("empresa-01"));
        $resource->setName("Banners")
            ->setAlias("Banner\Controller\Banner")
            ->setRoute("banner")
            ->setStatus(1)
            ->setDescription("Modulo Banners")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($resource);
        $this->addReference("resource-03", $resource);

        $resource = new ResourceEntity();

        $resource->setEmpresa($this->getReference("empresa-01"));
        $resource->setName("Blog")
            ->setAlias("Blog\Controller\Blog")
            ->setRoute("blog")
            ->setStatus(1)
            ->setDescription("Modulo Blog")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($resource);
        $this->addReference("resource-04", $resource);

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 22;
    }
}