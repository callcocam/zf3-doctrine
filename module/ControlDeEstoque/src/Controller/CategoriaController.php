<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class CategoriaController extends AbstractController
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
        $this->controller = "categoria";
        $this->template = sprintf("controle-estoque/categoria/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'ControlDeEstoque\Service\CategoriaService';
        $this->form = 'ControlDeEstoque\Form\CategoriaForm';
        $this->filter = 'ControlDeEstoque\Filter\CategoriaFilter';
        $this->setServiceManager('ControlDeEstoque\Table\CategoriaTable', $this->factoryTable);
        $this->setEntity('ControlDeEstoque\Entity\CategoriaEntity')->setTable('ControlDeEstoque\Table\CategoriaTable');
    }
}