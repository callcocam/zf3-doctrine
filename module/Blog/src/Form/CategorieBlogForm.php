<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Blog\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;

class CategorieBlogForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "blog/defalut",[
            'controller'=>"categorie-blog",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        $this->addText("name","Nome\Descrição");
        $this->addText("video","IDdo video");
        $this->addHidden("alias");
        $this->addTextArea("preview","Descrição");
        $this->addHidden("cover");
    }


}