<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class ClientController extends AbstractController
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
        $this->controller = "client";
        $this->template = sprintf("admin/client/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\ClientService';
        $this->form = 'Admin\Form\ClientForm';
        $this->filter = 'Admin\Filter\ClientFilter';
        $this->setServiceManager('Admin\Table\ClientTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\ClientEntity')->setTable('Admin\Table\ClientTable');
    }
}