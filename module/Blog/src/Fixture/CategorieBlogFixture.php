<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Blog\Fixture;


use Blog\Entity\CategorieBlogEntity;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CategorieBlogFixture extends AbstractFixture implements FixtureInterface, OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     * @throws \Doctrine\Common\DataFixtures\BadMethodCallException
     */
    public function load( ObjectManager $manager )
    {
        foreach (range(1,5) as $value){

            $categorieblog = new CategorieBlogEntity();

            $categorieblog->setName("Title $value")

                ->setPreview("<p>Content $value</p>");

            $manager->persist($categorieblog);

            $this->addReference("cat-$value", $categorieblog);

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
        return 100;
    }
}