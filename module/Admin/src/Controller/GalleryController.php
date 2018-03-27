<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class GalleryController extends AbstractController
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
        $this->controller = "gallery";
        $this->template = sprintf("admin/gallery/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Admin\Service\GalleryService';
        $this->form = 'Admin\Form\GalleryForm';
        $this->filter = 'Admin\Filter\GalleryFilter';
        $this->setServiceManager('Admin\Table\GalleryTable', $this->factoryTable);
        $this->setEntity('Admin\Entity\GalleryEntity')->setTable('Admin\Table\GalleryTable');
    }
}