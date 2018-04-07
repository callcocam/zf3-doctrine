<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Controller;

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
        $this->route = "siga-controle-estoque";
        $this->controller = "controle-estoque";
        $this->template = sprintf("controle-estoque/controle-estoque/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'ControlDeEstoque\Service\ControleEstoqueService';
        $this->form = 'ControlDeEstoque\Form\ControleEstoqueForm';
        $this->filter = 'ControlDeEstoque\Filter\ControleEstoqueFilter';
        $this->setServiceManager('ControlDeEstoque\Table\ControleEstoqueTable', $this->factoryTable);
        $this->setEntity('ControlDeEstoque\Entity\ControleEstoqueEntity')->setTable('ControlDeEstoque\Table\ControleEstoqueTable');
    }
}