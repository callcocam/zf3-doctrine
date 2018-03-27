<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 20/03/2018
 * Time: 19:48
 */

namespace Core\Table\Table;


use Core\Table\Table\Exception\LogicException;

class ActionsConfig
{

    protected $actions = [
        'add' => [
            "label" => "Adicionar",
            "attrs"=>[
                "class"=> "btn-success",
                "id" =>"add",
                "href" =>"",
            ],
            "action" =>"create",
            "ico" =>"fa fa-plus-circle",
            "state"=>['',1,2,3]
        ],
        'active' => [
            "label" => "Ativar",
            "attrs"=>[
                "class"=> "btn-warning actions",
                "id" =>"active",
                "href" =>"",
            ],
            "class"=> "actions btn-warning",
            "action" =>"state",
            "id" =>"1",
            "ico" =>"fa fa-check",
            "state"=>['',2,3]
        ],
        'inactive' => [
            "label" => "Desabilitar",
            "attrs"=>[
                "class"=> "actions bg-gray",
                "id" =>"inactive",
                "href" =>"",
            ],
            "action" =>"state",
            "id" =>"2",
            "ico" =>"fa fa-close",
            "state"=>['',1,3]
        ],
        "trash" =>[
            "label" => "Enviar p/ Lixeira",
            "attrs"=>[
                "class"=> "actions bg-blue",
                "id" =>"trash",
                "href" =>"",
            ],
            "action" =>"state",
            "id" =>"3",
            "ico" =>"fa fa-trash",
            "state"=>['',1,2]
        ] ,
        'trashall' => [
            "label" => "Esvaziar Lixeira",
            "attrs"=>[
                "class"=> "actions btn-danger",
                "id" =>"trashall",
                "href" =>"",
            ],
            "action" =>"delete",
            "ico" =>"fa fa-eraser",
            "state"=>[3]
        ],
        'csv' => [
            "label" => "Exportar",
            "attrs"=>[
                "type" =>"button",
                "class"=> "export-csv bg-aqua",
                "id" =>"csv",
            ],
            "type" =>"button",
            "ico" =>"fa fa-plus-circle",
            "state"=>[null,1,2,3]
        ],
        'ajuda' => [
            "label" => "Ajuda",
            "attrs"=>[
                "class"=> "ajuda bg-purple",
                "id" =>"",
                "href" =>"",
            ],
            "action" =>"ajuda",
            "ico" =>"fa fa-question-circle",
            "state"=>['',1,2,3]
        ]
    ];

    public function add($name,array $button = []){
       $this->actions[$name] = $button;
       return $this;
    }

    public function getActions(){
        return $this->actions;
    }

    public function getAction($name){
        if (!isset($this->actions[$name])) {
            throw new LogicException("name {$name} not found!");
        }
        return $this->actions[$name];
    }

    public function remove($name){
        if (!isset($this->actions[$name])) {
            throw new LogicException("name {$name} not found!");
        }
        unset($this->actions[$name]);
        return $this;
    }
}