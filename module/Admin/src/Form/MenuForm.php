<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;

class MenuForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "admin/defalut",[
            'controller'=>"menu",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        ################# name #################
        $this->add([
            'type'=>Text::class,
            'name'=>'name',
            'options'=>[
                'label'=>'Nome\Descrição'
            ],
            'attributes'=>[
                'id'=>'name',
                'class'=>'form-control',
                'placeholder'=>'Nome\Descrição',
                'required'=>true,
            ]
        ]);
        ################# icone #################
        $this->add([
            'type'=>Text::class,
            'name'=>'icone',
            'options'=>[
                'label'=>'Icone'
            ],
            'attributes'=>[
                'id'=>'icone',
                'class'=>'form-control',
                'placeholder'=>'Icone',
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


        ################# controller #################
        $this->add([
            'type'=>Text::class,
            'name'=>'controller',
            'options'=>[
                'label'=>'Controller'
            ],
            'attributes'=>[
                'id'=>'route',
                'class'=>'form-control',
                'placeholder'=>'Controller',
            ]
        ]);

        ################# action #################
        $this->add([
            'type'=>Text::class,
            'name'=>'action',
            'options'=>[
                'label'=>'Ação'
            ],
            'attributes'=>[
                'id'=>'route',
                'class'=>'form-control',
                'placeholder'=>'action',
            ]
        ]);

        ################# controller #################
        $this->add([
            'type'=>Text::class,
            'name'=>'controller',
            'options'=>[
                'label'=>'Controller'
            ],
            'attributes'=>[
                'id'=>'controller',
                'class'=>'form-control',
                'placeholder'=>'Controller',
            ]
        ]);

        ################# icone #################
        $this->add([
            'type'=>Text::class,
            'name'=>'icone',
            'options'=>[
                'label'=>'Icone'
            ],
            'attributes'=>[
                'id'=>'route',
                'class'=>'form-control',
                'placeholder'=>'Icone, Usado somentee no menu principal',
            ]
        ]);

        ################# description #################
        $this->add([
            'type'=>Text::class,
            'name'=>'description',
            'options'=>[
                'label'=>'Dica de tela'
            ],
            'attributes'=>[
                'id'=>'route',
                'class'=>'form-control',
                'placeholder'=>'Dica de tela',
            ]
        ]);

         ################# parent #################
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'parent',
            'attributes' => [
                'id'   => 'role',
                'class'   => 'form-control'
            ],
            'options' => [
                'label'=>"Parent",
                'object_manager' => $this->container->get('doctrine.entitymanager.orm_default'),
                'target_class'   => 'Admin\Entity\MenuEntity',
                'property'       => 'name',
                'is_method'      => true,
                'display_empty_item' => true,
                'empty_item_label'   => '--Selecione--',
                'option_attributes' => [
                    'class'   => 'form-control input-sm'
                ],
                'find_method'    => [
                    'name'   => 'findBy',
                    'params' => [
                        'criteria' => ['status' => 1],

                        // Use key 'orderBy' if using ORM
                        'orderBy'  => ['ordem' => 'ASC']
                    ],
                ],
            ],
        ]);


        $resources=array_merge($this->getResources('invokables'),$this->getResources('factories'));
        ################# alias #################
        $this->add([
            'type'=>Select::class,
            'name'=>'alias',
            'options'=>[
                'label'=>'Nome real',
                'disable_inarray_validator'=>true,
                'empty_option'=>'--Selecione--',
                'value_options'=>$resources
            ],
            'attributes'=>[
                'id'=>'alias',
                'class'=>'form-control',
                'required'=>true,
            ]
        ]);



        ################# ordem #################
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'ordem',
            'attributes' => [
                'id'   => 'ordem',
                'class'   => 'form-control'
            ],
            'options' => [
                'label'=>"Ordem",
                'object_manager' => $this->container->get('doctrine.entitymanager.orm_default'),
                'target_class'   => 'Admin\Entity\MenuEntity',
                'property'       => 'name',
                'is_method'      => true,
                'display_empty_item' => true,
                'empty_item_label'   => '--Selecione--',
                'find_method'    => [
                    'name'   => 'findBy',
                    'params' => [
                        'criteria' => ['status' => 1],

                        // Use key 'orderBy' if using ORM
                        'orderBy'  => ['id' => 'DESC']
                    ],
                ],
            ],
        ]);

        ################# route #################
        $this->add([
            'type' => 'DoctrineModule\Form\Element\ObjectSelect',
            'name' => 'route',

            'attributes' => [
                'id'   => 'route',
                'class'   => 'form-control'
            ],
            'options' => [
                'label'=>"Rota",
                'object_manager' => $this->container->get('doctrine.entitymanager.orm_default'),
                'target_class'   => 'Admin\Entity\ResourceEntity',
                'property'       => 'name',
                'is_method'      => true,
                'display_empty_item' => true,
                'empty_item_label'   => '--Selecione--',
                'find_method'    => [
                    'name'   => 'findBy',
                    'params' => [
                        'criteria' => ['status' => 1],

                        // Use key 'orderBy' if using ORM
                        'orderBy'  => ['id' => 'DESC']
                    ],
                ],
            ],
        ]);


    }


}