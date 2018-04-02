<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/04/2018
 * Time: 21:42
 */

namespace Admin\Service;


use Admin\Entity\EmpresaEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class EmpresaFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {

        $expressEntity = new EmpresaEntity();
        $expressEntity->setEmail("contato@sigasmart.com.br")
            ->setPhone("(48)3535-1603")
            ->setStreet("Oscar de oliveira lopes")
            ->setZip("88950-000")
            ->setNumber("355")
            ->setState("SC")
            ->setDistrict("Bela Vista")
            ->setCity("Jacinto Machado")
            ->setCountry("Brasil")
            ->setFantasia("SIGA-SMART")
            ->setSocial("SIGA-SMART")
            ->setDistrict("Sistema Inteligente de Gerenciamento e Admistração!")
            ->setDescription("Sistema Inteligente de Gerenciamento e Admistração!")
            ->setCover("img/default.jpg")
            ->setGoogle("114670982115068448665")
            ->setFacebook("claudio.coelho.175")
            ->setTwitter("callcocam")
            ->setLatitude("-29.0003557")
            ->setLongetude("-49.7612579")
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($expressEntity);

        $this->addReference("empresa-01", $expressEntity);

        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 1;
    }
}