<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;
use Zend\Form\Element\Text;

class ConfigForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "admin/defalut", [
            'controller' => "config",
            'action' => 'create'
        ]);

        $this->util = new Utils();

        ################# conf_name #################
        $this->add([
            'type' => Text::class,
            'name' => 'conf_name',
            'options' => [
                'label' => 'Nome\Descrição'
            ],
            'attributes' => [
                'id' => 'conf_name',
                'class' => 'form-control',
                'placeholder' => 'Nome\Descrição',
                'required' => true,
            ]
        ]);
        ################# conf_value #################
        $this->add([
            'type' => Text::class,
            'name' => 'conf_value',
            'options' => [
                'label' => 'Valor Da Configurção'
            ],
            'attributes' => [
                'id' => 'conf_value',
                'class' => 'form-control',
                'placeholder' => 'Valor Da Configurção',
                'required' => true,
            ]
        ]);
       ################# conf_type #################
        $this->add([
            'type' => Text::class,
            'name' => 'conf_type',
            'options' => [
                'label' => 'Tipo'
            ],
            'attributes' => [
                'id' => 'conf_type',
                'class' => 'form-control',
                'placeholder' => 'Tipo da configuração',
                'required' => true,
            ]
        ]);

    }


}