<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 26/03/2018
 * Time: 23:11
 */

namespace Register\Controller;


use Api\Controller\ApiController;
use Interop\Container\ContainerInterface;

class RegisterController extends ApiController
{

    /**
     * ApiController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}