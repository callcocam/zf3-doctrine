<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControleEstoque\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class ControleEstoqueController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }
}