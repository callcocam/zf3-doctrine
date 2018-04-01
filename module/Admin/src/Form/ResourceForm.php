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

class ResourceForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "admin/defalut",[
            'controller'=>"resource",
            'action'=>'create'
        ]);

        $this->util = new Utils();

        ################# name #################
        $this->addText('name', 'Nome\Descrição');
        $invokables = $this->getResources('invokables');
        $factories = $this->getResources('factories');
        $resources=[];
        if($invokables):
            foreach ($invokables as $key => $value) {
                $resources[$key]=$key;
            }
        endif;
        if($factories):
            foreach ($factories as $key => $value) {
                $resources[$key]=$key;
            }
        endif;
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
                'class'=>'form-control'
            ]
        ]);


        ################# route  #################
        $this->addText('route','Rota');

    }


}