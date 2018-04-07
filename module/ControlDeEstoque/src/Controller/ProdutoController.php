<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class ProdutoController extends AbstractController
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
        $this->controller = "produto";
        $this->template = sprintf("siga-controle-estoque/produto/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'ControlDeEstoque\Service\ProdutoService';
        $this->form = 'ControlDeEstoque\Form\ProdutoForm';
        $this->filter = 'ControlDeEstoque\Filter\ProdutoFilter';
        $this->setServiceManager('ControlDeEstoque\Table\ProdutoTable', $this->factoryTable);
        $this->setEntity('ControlDeEstoque\Entity\ProdutoEntity')->setTable('ControlDeEstoque\Table\ProdutoTable');
    }
}