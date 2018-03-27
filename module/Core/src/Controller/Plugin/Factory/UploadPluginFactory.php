<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 24/03/2018
 * Time: 16:10
 */

namespace Core\Controller\Plugin\Factory;


use Admin\Filter\UploadFilter;
use Admin\Form\UploadForm;
use Admin\Service\UploadService;
use Core\Controller\Plugin\UploadPlugin;
use Core\Image\ImagesUpload;
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class UploadPluginFactory implements FactoryInterface
{

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $imagesUpload = $container->get(ImagesUpload::class);
        $service = new UploadService($container->get("Doctrine\ORM\EntityManager"));
        $form = new UploadForm("AjaxUploadForm",[
            'container'=>$container
        ]);
        $filter = new UploadFilter($container);

        return new UploadPlugin($imagesUpload, $service, $form, $filter);
    }
}