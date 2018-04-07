<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class TagController extends AbstractController
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
        $this->controller = "tag";
        $this->template = sprintf("controle-estoque/tag/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'ControlDeEstoque\Service\TagService';
        $this->form = 'ControlDeEstoque\Form\TagForm';
        $this->filter = 'ControlDeEstoque\Filter\TagFilter';
        $this->setServiceManager('ControlDeEstoque\Table\TagTable', $this->factoryTable);
        $this->setEntity('ControlDeEstoque\Entity\TagEntity')->setTable('ControlDeEstoque\Table\TagTable');
    }
}