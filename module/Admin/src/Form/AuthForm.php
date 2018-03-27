<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Admin\Form;


use Core\Form\AbstractForm;

class AuthForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action',"auth/login");

        //######################## remember_me #######################
        $this->add([
            'type'  => 'checkbox',
            'name' => 'remember_me',
            'options' => [
                'label' => 'Remember me',
            ],
        ]);
        //######################## csrf #######################
        $this->add([
            'type' => 'csrf',
            'name' => 'csrf',
            'options' => [
                'csrf_options' => [
                    'timeout' => 600
                ]
            ],
        ]);
        //######################## redirect_url #######################
        $this->add([
            'type'  => 'hidden',
            'name' => 'redirect_url'
        ]);
        //######################## email #######################
        $this->add([
            'type'=>'email',
            'name' => 'email',
            'options'=>[
                'label'=>"Email"
            ],
            "attributes"=>[
                'id'=>"email",
                'class'=>'form-control validate',
                'placeholder'=>"Digite seu email",
                'ico'=>'glyphicon glyphicon-envelope'
            ]

        ]);

        //######################## password #######################
        $this->add([
            'type'=>'password',
            'name' => 'password',
            'options'=>[
                'label'=>"Senha"
            ],
            "attributes"=>[
                'id'=>"password",
                'class'=>'form-control validate',
                'placeholder'=>"Digite sua senha",
                'ico'=>'glyphicon glyphicon-lock'
            ]

        ]);
    }
}
