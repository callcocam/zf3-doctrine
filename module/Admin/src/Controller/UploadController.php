<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;
use Zend\View\Model\JsonModel;
use Zend\View\Model\ViewModel;

class UploadController extends AbstractController
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
        $this->controller = "upload";
        $this->template = sprintf("admin/upload/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\UploadService';
        $this->form = 'Admin\Form\UploadForm';
        $this->filter = 'Admin\Filter\UploadFilter';
        $this->setServiceManager('Admin\Table\UploadTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\UploadEntity')->setTable('Admin\Table\UploadTable');
    }

}