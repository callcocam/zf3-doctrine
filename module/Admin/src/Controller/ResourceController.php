<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class ResourceController extends AbstractController
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
        $this->controller = "resource";
        $this->template = sprintf("admin/resource/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\ResourceService';
        $this->form = 'Admin\Form\ResourceForm';
        $this->filter = 'Admin\Filter\ResourceFilter';
        $this->setServiceManager('Admin\Table\ResourceTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\ResourceEntity')->setTable('Admin\Table\ResourceTable');
    }
}