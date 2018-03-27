<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class MenuController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->route = "adm-admin";
        $this->controller = "menu";
        $this->template = sprintf("admin/menu/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\MenuService';
        $this->form = 'Admin\Form\MenuForm';
        $this->filter = 'Admin\Filter\MenuFilter';
        $this->setServiceManager('Admin\Table\MenuTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\MenuEntity')->setTable('Admin\Table\MenuTable');
    }
}