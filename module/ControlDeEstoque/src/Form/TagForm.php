<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;

class TagForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "controle-estoque/defalut",[
            'controller'=>"tag",
            'action'=>'create'
        ]);

        $this->util = new Utils();

    }


}