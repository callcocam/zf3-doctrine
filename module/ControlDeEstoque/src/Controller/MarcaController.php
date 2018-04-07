<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class MarcaController extends AbstractController
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
        $this->controller = "marca";
        $this->template = sprintf("controle-estoque/marca/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'ControlDeEstoque\Service\MarcaService';
        $this->form = 'ControlDeEstoque\Form\MarcaForm';
        $this->filter = 'ControlDeEstoque\Filter\MarcaFilter';
        $this->setServiceManager('ControlDeEstoque\Table\MarcaTable', $this->factoryTable);
        $this->setEntity('ControlDeEstoque\Entity\MarcaEntity')->setTable('ControlDeEstoque\Table\MarcaTable');
    }
}