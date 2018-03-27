<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Auth\Form;


use Core\Form\AbstractForm;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Select;
use Zend\Form\Element\Text;

class LoginForm extends AbstractForm
{

	public function __construct($name = null, array $options = [])
	{
		parent::__construct($name, $options);
        $this->setAttribute('action',"auth/login");



		//######################## email #######################
		$this->add([
			'type'=>'email',
			'name' => 'email',
			'options'=>[
				//'label'=>"Email"
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
				//'label'=>"Senha"
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