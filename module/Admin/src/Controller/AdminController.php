<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
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