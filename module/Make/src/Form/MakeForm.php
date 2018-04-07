<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 13:40
 */

namespace Make\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;
use Zend\Form\Element\Text;

class MakeForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "auth/login");

        $this->util = new Utils();
        //######################## name #######################
        $this->add([
            'type' => Text::class,
            'name' => 'name',
            'options' => [
                'label' => "Primeiro Nome:"
            ],
            "attributes" => [
                'id' => "name",
                'class' => 'form-control validate',
                'placeholder' => "Digite um nome"
            ]

        ]);

        //######################## route #######################
        $this->addSelect("menu","Menu Ou Sub-Menu",[
            'menu'=>"Menu Principal",
            'submenu'=>"Sub Menu"
        ]);

        //######################## route #######################
        $this->add([
            'type' => Text::class,
            'name' => 'route',
            'options' => [
                'label' => "Rota para o modulo:"
            ],
            "attributes" => [
                'id' => "route",
                'class' => 'form-control validate',
                'placeholder' => "Digite o nome da rota"
            ]

        ]);

        //######################## controller #######################
        $this->add([
            'type' => Text::class,
            'name' => 'controller',
            'options' => [
                'label' => "Controller:"
            ],
            "attributes" => [
                'id' => "controller",
                'class' => 'form-control validate',
                'placeholder' => "Digite o nome do controller"
            ]

        ]);
        //######################## alias #######################
        $this->add([
            'type' => Text::class,
            'name' => 'alias',
            'options' => [
                'label' => "Nome real:"
            ],
            "attributes" => [
                'id' => "alias",
                'class' => 'form-control validate',
                'placeholder' => "Digite o nome real"
            ]

        ]);

        //######################## description #######################
        $this->add([
            'type' => Text::class,
            'name' => 'description',
            'options' => [
                'label' => "Descrição:"
            ],
            "attributes" => [
                'id' => "description",
                'class' => 'form-control validate',
                'placeholder' => "Digite Descrição"
            ]

        ]);
    }


}