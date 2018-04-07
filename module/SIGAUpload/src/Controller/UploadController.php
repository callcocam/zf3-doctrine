<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace SIGAUpload\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

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
        $this->route = "siga-upload";
        $this->controller = "upload";
        $this->template = sprintf("siga-upload/upload/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'SIGAUpload\Service\UploadService';
        $this->form = 'SIGAUpload\Form\UploadForm';
        $this->filter = 'SIGAUpload\Filter\UploadFilter';
        $this->setServiceManager('SIGAUpload\Table\UploadTable', $this->factoryTable);
        $this->setEntity('SIGAUpload\Entity\UploadEntity')->setTable('SIGAUpload\Table\UploadTable');
    }
}