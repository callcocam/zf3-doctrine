<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;
use Zend\Form\Element\Select;

class PrivilegeForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "admin/defalut",[
            'controller'=>"privilege",
            'action'=>'create'
        ]);

        $this->util = new Utils();

        ################# parent #################
        $this->add([
            'type'=>Select::class,
            'name'=>'parent',
            'options'=>[
                'label'=>'Privilégios\Default',
                'disable_inarray_validator'=>true,
                'empty_option'=>'--Selecione--',
                'value_options'=>[
                    'upload,gallery,listgallery,deletegalleryitem,file,index,listar'=>"Listar",
                    'state,upload,gallery,listgallery,deletegalleryitem,file,index,listar'=>"Listar e alterar status",
                    'state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,editar-form'=>"Listar, alterar status e Editar",
                    'state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form'=>"Listar, alterar status, Editar e Criar",
                    'state,upload,gallery,listgallery,deletegalleryitem,file,index,listar,editar,create,editar-form,delete'=>"Listar, alterar status, Editar, Criare e Deletar",
                ]
            ],
            'attributes'=>[
                'id'=>'action',
                'class'=>'form-control',
                'required'=>true,
            ]
        ]);

        ################# name #################
        $this->addText("name","Nome");


        ################# action #################
        $this->addText("action","Privilegios Extra");

        $resources=array_merge($this->getResources('invokables'),$this->getResources('factories'));
        ################# controller #################
        $this->add([
            'type'=>Select::class,
            'name'=>'controller',
            'options'=>[
                'label'=>'Controller',
                'disable_inarray_validator'=>true,
                'empty_option'=>'--Selecione--',
                'value_options'=>$resources
            ],
            'attributes'=>[
                'id'=>'controller',
                'class'=>'form-control',
                'required'=>true,
            ]
        ]);
        ################# role #################
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'role',
            'attributes' => [
                'id'   => 'role',
                'class'   => 'form-control'
            ],
            'options' => [
                'label'=>"Controle de Acesso",
                'object_manager' => $this->container->get('doctrine.entitymanager.orm_default'),
                'target_class'   => 'Admin\Entity\RoleEntity',
                'property'       => 'name',
                'is_method'      => true,
                'display_empty_item' => true,
                'empty_item_label'   => '--Selecione--',
                'find_method'    => [
                    'name'   => 'findBy',
                    'params' => [
                        'criteria' => ['status' => 1]
                    ],
                ],
            ],
        ]);
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'resource',
            'attributes' => [
                'id'   => 'resource',
                'class'   => 'form-control'
            ],
            'options' => [
                'label'=>"Modulo",
                'object_manager' => $this->container->get('doctrine.entitymanager.orm_default'),
                'target_class'   => 'Admin\Entity\ResourceEntity',
                'property'       => 'name',
                'is_method'      => true,
                'display_empty_item' => true,
                'empty_item_label'   => '--Selecione--',
                'find_method'    => [
                    'name'   => 'findBy',
                    'params' => [
                        'criteria' => ['status' => 1]
                    ],
                ],
            ],
        ]);
    }


}