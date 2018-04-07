<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 15:37
 */

namespace VodkaEverest\Controller\Factory;


use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class FactoryController implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /**
         * @var  $controller AbstractController
         */
        $controller = (new \ReflectionClass(sprintf("%sController", $requestedName)))->newInstance($container);
        return $controller;
    }
}