<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 11:37
 */

namespace Admin\Controller;


use Core\Controller\AbstractController;
use Core\Entity\AbstractRepository;
use Interop\Container\ContainerInterface;
use Zend\Debug\Debug;

class AdminController extends AbstractController
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