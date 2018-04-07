<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Banner\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;

class BannerForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "vodka-everest/defalut",[
            'controller'=>"banner",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        $this->addText("name","Nome\Descrição");
        $this->addText("alias","Link De Acesso");
        $this->addTextArea("preview","Descrição");
        $this->addHidden("cover");
    }


}