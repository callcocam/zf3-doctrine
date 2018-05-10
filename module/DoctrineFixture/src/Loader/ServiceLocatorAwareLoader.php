<?php

namespace DoctrineFixture\Loader;

use Doctrine\Common\DataFixtures\Loader as BaseLoader;
use Interop\Container\ContainerInterface;
use Doctrine\Common\DataFixtures\FixtureInterface;

/**
 * Doctrine fixture loader which is ZF2 Service Locator-aware
 * Will inject the service locator instance into all SL-aware fixtures on add
 *
 * @license http://www.opensource.org/licenses/lgpl-license.php LGPL
 * @link    www.doctrine-project.org
 * @author  Adam Lundrigan <adam@lundrigan.ca>
 */
class ServiceLocatorAwareLoader extends BaseLoader
{
    /**
     * @var ContainerInterface
     */
    protected $serviceLocator;

    public function __construct(ContainerInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
    }

    /**
     * Add a fixture object instance to the loader.
     *
     * @param FixtureInterface $fixture
     */
    public function addFixture(FixtureInterface $fixture)
    {
        if ($fixture instanceof ContainerInterface) {
            $fixture->setServiceLocator($this->serviceLocator);
        }
        parent::addFixture($fixture);
    }
}
