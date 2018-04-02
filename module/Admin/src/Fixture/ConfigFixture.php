<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 02/04/2018
 * Time: 02:27
 */

namespace Admin\Service;


use Admin\Entity\ConfigEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ConfigFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {
        $config = new ConfigEntity();
        $config->setConfName("ADMIN_NAME")
            ->setConfValue("SIGA-SMART")
            ->setConfType("ADMIN")
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($config);

        $config = new ConfigEntity();
        $config->setConfName("ADMIN_DESC")
            ->setConfValue("APP Desenvolvida para facilitar o desenvolvimento de APP`S proficionais e em alta velocidade, agilizando o desenvolvimento!")
            ->setConfType("ADMIN")
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($config);

        $config = new ConfigEntity();
        $config->setConfName("ADMIN_MAINTENANCE")
            ->setConfValue("0")
            ->setConfType("ADMIN")
            ->setStatus(1)
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($config);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
       return 25;
    }
}