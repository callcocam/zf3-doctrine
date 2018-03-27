<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Admin\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;

class GalleryForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "admin/defalut",[
            'controller'=>"gallery",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        $this->addText("name","Nome");
        $this->addTextArea("description","Descrição");
        $this->addHidden("assets");
        $this->addHidden("cover");
        $this->addHidden("path");
        $this->addHidden("parent");
    }


}