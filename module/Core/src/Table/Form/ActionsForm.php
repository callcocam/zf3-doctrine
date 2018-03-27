<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 20/03/2018
 * Time: 20:10
 */

namespace Table\Form;


use Zend\Form\Element\Button;
use Zend\Form\Form;

class ActionsForm extends Form
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);

        //######################## submit #######################
        $this->add([
            'type' => Button::class,
            'name' => 'add',
            "attributes" => [
                'id' => "add",
                'class' => 'btn-success',
                'value' => "Adicionar",
            ],
        ]);
        //######################## save_copy #######################
        $this->add([
            'type' => Button::class,
            'name' => 'save_copy',
            "attributes" => [
                'id' => "button",
                'class' => 'btn btn-warning btn-block btn-flat btn-block',
                'value' => "Duplicar Cadastro",
            ],
        ]);
        //######################## save_close #######################
        $this->add([
            'type' => Button::class,
            'name' => 'save_close',
            "attributes" => [
                'id' => "button",
                'class' => 'btn btn-success btn-block btn-flat btn-block',
                'value' => "Atualizar e Fechar",
            ],
        ]);
    }
}