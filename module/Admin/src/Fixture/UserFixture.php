<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 01/04/2018
 * Time: 17:50
 */

namespace Admin\Fixture;


use Admin\Entity\UserEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Zend\Crypt\Key\Derivation\Pbkdf2;

class UserFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {
        $user = new UserEntity();
        $user->setEmpresa($this->getReference("empresa-01"))
            ->setFirstName("Administardor")
            ->setLastName("Sisteme")
            ->setEmail("contato@sigasmart.com.br")
            ->setPassword($this->encryptPassword("contato@sigasmart.com.br", "Security"))
            ->setStatus(1)
            ->setAccess($this->getReference("role-01"))
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());
        $manager->persist($user);
        $this->addReference("user-01",$user);
        $manager->flush();

    }

    public function encryptPassword( $email, $password )
    {
        return base64_encode(Pbkdf2::calc('sha256', $password, $email, 10000, strlen($password) * 2));
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
       return 21;
    }
}