<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControleEstoque\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class ProductController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->route = "adm-controle-estoque";
        $this->controller = "product";
        $this->template = sprintf("controle-estoque/product/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'ControleEstoque\Service\ProductService';
        $this->form = 'ControleEstoque\Form\ProductForm';
        $this->filter = 'ControleEstoque\Filter\ProductFilter';
        $this->setServiceManager('ControleEstoque\Table\ProductTable', $this->factoryTable);
        $this->setEntity('ControleEstoque\Entity\ProductEntity')->setTable('ControleEstoque\Table\ProductTable');
    }
}