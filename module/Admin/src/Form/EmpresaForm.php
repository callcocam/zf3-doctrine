<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;

class EmpresaForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "admin/defalut",[
            'controller'=>"empresa",
            'action'=>'create'
        ]);

        $this->util = new Utils();

    }


}