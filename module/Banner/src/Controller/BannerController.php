<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Banner\Controller;

use Core\Controller\AbstractController;
use Interop\Container\ContainerInterface;

class BannerController extends AbstractController
{

    /**
     * AbstractController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct(ContainerInterface $container)
    {
        $this->route = "adm-banner";
        $this->controller = "banner";
        $this->template = sprintf("banner/banner/%s/editar-form", LAYOUT);
        $this->container = $container;
        $this->service = 'Banner\Service\BannerService';
        $this->form = 'Banner\Form\BannerForm';
        $this->filter = 'Banner\Filter\BannerFilter';
        $this->setServiceManager('Banner\Table\BannerTable', $this->factoryTable);
        $this->setEntity('Banner\Entity\BannerEntity')->setTable('Banner\Table\BannerTable');
    }
}