<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 24/03/2018
 * Time: 15:47
 */

namespace Core\Controller\Plugin;


use Admin\Entity\UploadEntity;
use Admin\Filter\UploadFilter;
use Admin\Form\UploadForm;
use Admin\Service\UploadService;
use Core\Entity\AbstractEntity;
use Core\Entity\AbstractRepository;
use Core\Image\ImagesUpload;
use Zend\Mvc\Controller\Plugin\AbstractPlugin;

class UploadPlugin extends AbstractPlugin
{

    /**
     * @var UploadService
     */
    private $service;
    /**
     * @var UploadForm
     */
    private $form;
    /**
     * @var UploadFilter
     */
    private $filter;
    /**
     * @var $repository
     */
    private $repository;

    /**
     * @var ImagesUpload
     */
    private $ImagesUpload;
    /**
     * @var array
     */
    private $data;
    /**
     * @var array
     */
    private $File;
    /**
     * @var array
     */
    private $Query;

    /**
     * @return UploadService
     */
    public function getService(): UploadService
    {
        return $this->service;
    }

    /**
     * @param UploadService $service
     * @return UploadPlugin
     */
    public function setService( UploadService $service ): UploadPlugin
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return UploadForm
     */
    public function getForm(): UploadForm
    {
        return $this->form;
    }

    /**
     * @param UploadForm $form
     * @return UploadPlugin
     */
    public function setForm( UploadForm $form ): UploadPlugin
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return UploadFilter
     */
    public function getFilter(): UploadFilter
    {
        return $this->filter;
    }

    /**
     * @param UploadFilter $filter
     * @return UploadPlugin
     */
    public function setFilter( UploadFilter $filter ): UploadPlugin
    {
        $this->filter = $filter;
        return $this;
    }

    /**
     * @return $repository
     */
    public function getRepository()
    {
        return $this->repository;
    }

    /**
     * @param $repository
     * @return UploadPlugin
     */
    public function setRepository( $repository )
    {
        $this->repository = $repository;
        return $this;
    }

    /**
     * @return ImagesUpload
     */
    public function getImagesUpload(): ImagesUpload
    {
        return $this->ImagesUpload;
    }

    /**
     * @param ImagesUpload $ImagesUpload
     * @return UploadPlugin
     */
    public function setImagesUpload( ImagesUpload $ImagesUpload ): UploadPlugin
    {
        $this->ImagesUpload = $ImagesUpload;
        return $this;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     * @return UploadPlugin
     */
    public function setData( array $data ): UploadPlugin
    {
        $this->data = $data;
        return $this;
    }

    /**
     * @return array
     */
    public function getFile(): array
    {
        return $this->File;
    }

    /**
     * @param array $File
     * @return UploadPlugin
     */
    public function setFile( array $File ): UploadPlugin
    {
        $this->File = $File;
        return $this;
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->Query;
    }

    /**
     * @param array $Query
     * @return UploadPlugin
     */
    public function setQuery( array $Query ): UploadPlugin
    {
        $this->Query = $Query;
        return $this;
    }


    public function upload( $BasePath )
    {

        $Result = [];
        if ($this->data):
            $this->data['path'] = $BasePath;
            $this->form->setData($this->data);
            if ($this->form->isValid()):
                //Verifica se existe uma imagem para enviar
                if ($this->File):
                    $this->ImagesUpload->setBasePath($BasePath);
                    $Result = $this->ImagesUpload->persistFile($this->File['file'], [
                        'controller' => $this->data['assets'],
                        'id' => $this->data['parent'],
                    ]);
                    $this->data['cover'] = $Result['location'];
                    $this->data['path'] = $Result['path'];
                endif;
                //Salva ou atualiza os dados
                $Result = array_merge($Result, $this->service->save($this->data));
            endif;
        else:
            if ($this->Query) {
                unset($this->Query['name']);
                $File = $this->repository->findOneBy($this->Query);
                 if ($File) {
                    $this->form->setData($this->extracted($File->toArray()));
                }

            }
        endif;
        return $Result;
    }

    public function uploadmce( $id, $controller, $BasePath )
    {
        $this->ImagesUpload->setBasePath($BasePath);
        $Result = $this->ImagesUpload->persistFile($this->File['file'], [
            'controller' => $controller,
            'id' => $id,
        ]);
        return $Result;
    }

    protected function extracted( $data, $suffix = "copy" )
    {
        foreach ($data as $key => $value) {
            if ($value instanceof \Datetime):
                $data[$key] = $value->format("Y/m/d");
            else:
                if ($value instanceof AbstractEntity) {
                    $methodName = 'get' . ucfirst($key);
                    if (method_exists($value, $methodName)) {
                        $value = $value->getId();
                    }
                }
                if (strstr($value, $suffix, true)) {
                    $data[$key] = strstr($value, $suffix, true);
                } else {
                    $data[$key] = $value;
                }

            endif;
        }
        return $data;
    }

}