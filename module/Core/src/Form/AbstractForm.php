<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 13:41
 */

namespace Core\Form;


use Zend\Form\Element\Hidden;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Form;

class AbstractForm extends Form
{
    protected $container;

    protected $util;

    /**
     * @param $name
     * @param array $options
     */
    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('method', 'post');
        if (isset($options['container'])):
            $this->container = $options['container'];
        endif;

        //######################## id #######################
        $this->add([
            'type' => Hidden::class,
            'name' => 'id',
            "attributes" => [
                'id' => "id",
            ],

        ]);

        //######################## empresa #######################
        $this->add([
            'type' => Hidden::class,
            'name' => 'empresa',
            "attributes" => [
                'id' => "empresa",
            ],

        ]);

        ################# status #################
        $this->add([
            'type' => \Zend\Form\Element\Select::class,
            'name' => 'status',
            'options' => [
                'disable_inarray_validator' => true,
                'label' => 'Status',
                //'empty_option'=>'--Selecione--',
                'value_options' => [
                    '1' => "Ativo",
                    '2' => "Inativo",
                ],
            ],
            'attributes' => [
                'id' => 'status',
                'class' => 'form-control',
                'value' => '1',
            ],
        ]);

        //######################## created_at #######################
        $this->add([
            'type' => Text::class,
            'name' => 'created_at',
            'options' => [
                'label' => "Criado em:",
            ],
            "attributes" => [
                'id' => "created_at",
                'class' => 'form-control validate date',
                'placeholder' => "00/00/0000",
                'readonly' => true,
                'value' => date("d/m/Y"),
            ],

        ]);

        //######################## updated_at #######################
        $this->add([
            'type' => Text::class,
            'name' => 'updated_at',
            'options' => [
                'label' => "Atualizado em:",
            ],
            "attributes" => [
                'id' => "updated_at",
                'class' => 'form-control validate datetime',
                'placeholder' => "00/00/0000 00:00",
                'readonly' => true,
                'value' => date("d/m/Y H:i"),
            ],

        ]);

        //######################## submit #######################
        $this->add([
            'type' => Submit::class,
            'name' => 'submit',
            "attributes" => [
                'id' => "submit",
                'class' => 'btn btn-primary btn-block btn-flat btn-block',
                'value' => "Atualizar Cadastro",
            ],
        ]);
        //######################## save_copy #######################
        $this->add([
            'type' => Submit::class,
            'name' => 'save_copy',
            "attributes" => [
                'id' => "save_copy",
                'class' => 'btn btn-warning btn-block btn-flat btn-block',
                'value' => "Duplicar Cadastro",
            ],
        ]);
        //######################## save_close #######################
        $this->add([
            'type' => Submit::class,
            'name' => 'save_close',
            "attributes" => [
                'id' => "save_close",
                'class' => 'btn btn-success btn-block btn-flat btn-block',
                'value' => "Atualizar e Fechar",
            ],
        ]);

    }

    public function addText($name,$label,array $flags = [])
    {
        //######################## Text #######################
        $elementOrFieldset = array_merge([
            'type' => Text::class,
            'name' => $name,
            'options' => [
                'label' => $label,
            ],
            "attributes" => [
                'id' => $name,
                'class' => 'form-control validate',
                'placeholder' => $label,
                'title' => $label
            ],

        ],$flags);
        return parent::add($elementOrFieldset);
    }
    public function addTextArea($name,$label,array $flags = [])
    {
        //######################## Text #######################
        $elementOrFieldset = array_merge([
            'type' => Textarea::class,
            'name' => $name,
            'options' => [
                'label' => $label,
            ],
            "attributes" => [
                'id' => $name,
                'class' => 'form-control validate',
                'placeholder' => $label,
                'title' => $label
            ],

        ],$flags);
        return parent::add($elementOrFieldset);
    }

    public function addHidden($name,array $flags = [])
    {
        //######################## Hidden #######################
        $elementOrFieldset = array_merge([
            'type' => Hidden::class,
            'name' => $name,
            "attributes" => [
                'id' => $name
            ]
        ],$flags);
        return parent::add($elementOrFieldset);
    }

    /**
     * @param $field
     * @param $Value
     * @param $class
     * @return mixed
     */
    public function dataValidate($field, $Value, $class = false)
    {
        if ($this->has($field)):
            if ($this->util->form_diasEntreData($this->get($Value)->getValue(), date("d/m/Y"), "1")):
                $this->get($field)->setAttribute('readonly', true);
                if ($class):
                    $this->get($field)->setAttribute('class', 'form-control');
                endif;
            endif;
        endif;
        return $this;
    }

    /**
     * @param $string
     * @return mixed
     */
    protected function getResources($string)
    {
        $resources = [];
        if (!isset($this->container->get('Config')['controllers'][$string])):
            return [];
        endif;
        $Result = $this->container->get('Config')['controllers'][$string];
        if ($Result):
            foreach ($Result as $key => $value) {
                $resources[$key] = $key;
            }
        endif;

        return $resources;

    }
}