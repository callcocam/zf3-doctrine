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
use Core\Filter\AbstractFilter;
use Core\Form\AbstractForm;
use Core\Image\ImagesUpload;
use Core\Service\AbstractService;
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
     * @return AbstractService
     */
    public function getService(): AbstractService
    {
        return $this->service;
    }

    /**
     * @param AbstractService $service
     * @return UploadPlugin
     */
    public function setService( AbstractService $service ): UploadPlugin
    {
        $this->service = $service;
        return $this;
    }

    /**
     * @return AbstractForm
     */
    public function getForm(): AbstractForm
    {
        return $this->form;
    }

    /**
     * @param UploadForm $form
     * @return UploadPlugin
     */
    public function setForm( AbstractForm $form ): UploadPlugin
    {
        $this->form = $form;
        return $this;
    }

    /**
     * @return AbstractFilter
     */
    public function getFilter(): AbstractFilter
    {
        return $this->filter;
    }

    /**
     * @param AbstractFilter $filter
     * @return UploadPlugin
     */
    public function setFilter( AbstractFilter $filter ): UploadPlugin
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
                else:
                    $Result=[
                        'type'=>'error',
                        'msg'=>$this->getFormMessages($this->form->getMessages()),
                        'result'=>false
                    ];
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
    protected function getFormMessages( $Msgs )
    {
        if ($Msgs):
            $ArayMsg = [];
            foreach ($Msgs as $msg) {
                $ArayMsg[] = array_pop($msg);
            }
            return str_replace("'", "-", implode(PHP_EOL, $ArayMsg));
        endif;
        return "Nenhuma informação disponivel";
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