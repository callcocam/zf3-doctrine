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
        $this->addText("social","Razão social");
        $this->addText("tipo","Tipo");
        $this->addText("cnpj","Cnpj");
        $this->addText("ie","EI");
        $this->addText("email","E-Mail");
        $this->addText("fantasia","Nome Fantasia");
        $this->addText("phone","Phone");
        $this->addText("facebook","Facebook");
        $this->addText("google","Google");
        $this->addText("twitter","Twitter");
        $this->addText("street","Endereço");
        $this->addText("complements","Complemeto");
        $this->addText("number","Numero");
        $this->addText("district","Detrito");
        $this->addText("city","Cidade");
        $this->addText("state","Uf");
        $this->addText("country","Brasil");
        $this->addText("longetude","Longetude");
        $this->addText("latitude","Latitude");
        $this->addTextArea("description","Descrição",['attributes'=>[
            'class'=>'form-control tiny_mce'
        ]]);
        $this->addHidden("cover");
    }


}