<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Agenda\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;

class CategorieForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "agenda/defalut",[
            'controller'=>"categorie",
            'action'=>'create'
        ]);

        $this->util = new Utils();

        $this->util = new Utils();
        $this->addText("title", "Nome\Descrição");
        $this->addSelect("class_name", "Cor", [
            "success" => "Success",
            "danger" => "Danger",
            "info" => "Info",
            "pink" => "Pink",
            "primary" => "Primary",
            "warning" => "Warning",
            "inverse" => "Inverse"
        ]);

        $this->addTextArea("description", "Descrição");
    }


}