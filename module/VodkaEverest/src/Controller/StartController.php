<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 11:43
 */

namespace VodkaEverest\Controller;


use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class StartController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}