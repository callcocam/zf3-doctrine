<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;
use Zend\Form\Element\Select;

class RoleForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "admin/defalut",[
            'controller'=>"role",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        $this->addText("name","Nome");
        $this->addText("alias","Alias");
        $this->add([
            'type'=> Select::class,
            'name'=>'is_admin',
            'options'=>[
                'disable_inarray_validator'=>true,
                'label'=>'Todos os privilégios',
                'empty_option'=>'--Selecione--',
                'value_options'=>[
                    1=>'Sim'
                ]
            ],
            'attributes'=>[
                'id'=>'is_admin',
                'class'=>'form-control'
            ]
        ]);
    }


}