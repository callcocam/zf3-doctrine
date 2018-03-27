<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class RoleController extends AbstractController
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
        $this->controller = "role";
        $this->template = sprintf("admin/role/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\RoleService';
        $this->form = 'Admin\Form\RoleForm';
        $this->filter = 'Admin\Filter\RoleFilter';
        $this->setServiceManager('Admin\Table\RoleTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\RoleEntity')->setTable('Admin\Table\RoleTable');
    }
}