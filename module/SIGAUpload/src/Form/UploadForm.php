<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace SIGAUpload\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;

class UploadForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "upload/defalut",[
            'controller'=>"upload",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        $this->util = new Utils();
        $this->addText("name","Nome");
        $this->addText("cover_height","Largura");
        $this->addText("cover_width","Altura");
        $this->addText("cover_quality","Qualidade");
        $this->get('cover_height')->setValue("600");
        $this->get('cover_width')->setValue("800");
        $this->get('cover_quality')->setValue("90");
        $this->addTextArea("description","Descrição");
        $this->addHidden("tipo");
        $this->addHidden("assets");
        $this->addHidden("cover");
        $this->addHidden("path");
        $this->addHidden("parent");
        $this->addHidden("status");
        $this->get('status')->setValue("1");
    }


}