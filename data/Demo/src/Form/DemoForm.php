<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace S_Demo\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;

class S_NameForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "S_route/defalut",[
            'controller'=>"S_controller",
            'action'=>'create'
        ]);

        $this->util = new Utils();

    }


}