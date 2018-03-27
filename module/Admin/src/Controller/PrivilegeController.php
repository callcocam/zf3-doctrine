<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class PrivilegeController extends AbstractController
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
        $this->controller = "privilege";
        $this->template = sprintf("admin/privilege/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\PrivilegeService';
        $this->form = 'Admin\Form\PrivilegeForm';
        $this->filter = 'Admin\Filter\PrivilegeFilter';
        $this->setServiceManager('Admin\Table\PrivilegeTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\PrivilegeEntity')->setTable('Admin\Table\PrivilegeTable');
    }
}