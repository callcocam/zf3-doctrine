<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Blog\Fixture;


use Blog\Entity\PostEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class PostFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {

        foreach (range(1, 40) as $value) {
            $cat = $this->getReference("cat-" . rand(1, 5));
            $post = new PostEntity();
            $post->setEmpresa($this->getReference("empresa-01"));
            $post->setAuthor($this->getReference("user-01"));
            $post->setCategorie($cat);
            $post->setName("Posts Title {$value}");
            $post->setPreview("Posts Preview {$value}");
            $post->setDescription("Posts Descripion {$value}");
            $index = str_pad($value, 2, "0", STR_PAD_LEFT);
            $post->setCover("assets-vodka-everrest/images/art/work{$index}.jpg");
            $manager->persist($post);
        }
        $manager->flush();
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 101;
    }
}