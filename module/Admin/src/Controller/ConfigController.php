<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class ConfigController extends AbstractController
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
        $this->controller = "config";
        $this->template = sprintf("admin/config/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\ConfigService';
        $this->form = 'Admin\Form\ConfigForm';
        $this->filter = 'Admin\Filter\ConfigFilter';
        $this->setServiceManager('Admin\Table\ConfigTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\ConfigEntity')->setTable('Admin\Table\ConfigTable');
    }
}