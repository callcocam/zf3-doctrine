<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 08/04/2018
 * Time: 23:09
 */

namespace Api\Controller;


use Core\Image\ImagesUpload;
use Interop\Container\ContainerInterface;
use Zend\View\Model\JsonModel;

class UploadController extends ApiController
{

    /**
     * ApiController constructor.
     * @param ContainerInterface $container
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __construct( ContainerInterface $container )
    {
        $this->route = "siga-upload";
        $this->controller = "upload";
        $this->container = $container;
        $this->form = 'SIGAUpload\Form\UploadForm';
        $this->service = 'SIGAUpload\Service\UploadService';
        $this->filter = 'SIGAUpload\Filter\UploadFilter';
        $this->setServiceManager('SIGAUpload\Table\UploadTable', $this->factoryTable);
        $this->setEntity('SIGAUpload\Entity\UploadEntity')->setTable('SIGAUpload\Table\UploadTable');
    }

    public function create( $data )
    {

        if (is_string($this->service)):
            $this->getService();
        endif;
        if (is_string($this->form)):
            $this->getForm();
        endif;
        if (is_string($this->filter)):
            $this->getFilter();
        endif;
        $this->apiResponse = array_merge($this->args, $this->UploadPlugin()
            ->setService($this->service)
            ->setForm($this->form)
            ->setImagesUpload($this->container->get(ImagesUpload::class))
            ->setFilter($this->filter)
            ->setRepository($this->repository)
            ->setQuery($this->params()->fromQuery())
            ->setData($this->params()->fromPost())
            ->setFile($this->params()->fromFiles())
            ->upload($this->getRequest()->getServer('DOCUMENT_ROOT')));

        return $this->createResponse();
    }
}