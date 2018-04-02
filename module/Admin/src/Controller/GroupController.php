<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class GroupController extends AbstractController
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
        $this->controller = "group";
        $this->template = sprintf("admin/group/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\GroupService';
        $this->form = 'Admin\Form\GroupForm';
        $this->filter = 'Admin\Filter\GroupFilter';
        $this->setServiceManager('Admin\Table\GroupTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\GroupEntity')->setTable('Admin\Table\GroupTable');
    }
}