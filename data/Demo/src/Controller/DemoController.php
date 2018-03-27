<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace S_Demo\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class S_NameController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->route = "adm-S_route";
        $this->controller = "S_controller";
        $this->template = sprintf("S_route/S_controller/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'S_Demo\Service\S_NameService';
        $this->form = 'S_Demo\Form\S_NameForm';
        $this->filter = 'S_Demo\Filter\S_NameFilter';
        $this->setServiceManager('S_Demo\Table\S_NameTable', $this->factoryTable);
        $this->setEntity('S_Demo\Entity\S_NameEntity')->setTable('S_Demo\Table\S_NameTable');
    }
}