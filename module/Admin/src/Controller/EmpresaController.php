<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class EmpresaController extends AbstractController
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
        $this->controller = "empresa";
        $this->template = sprintf("admin/empresa/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\EmpresaService';
        $this->form = 'Admin\Form\EmpresaForm';
        $this->filter = 'Admin\Filter\EmpresaFilter';
        $this->setServiceManager('Admin\Table\EmpresaTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\EmpresaEntity')->setTable('Admin\Table\EmpresaTable');
    }
}