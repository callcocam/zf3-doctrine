<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Blog\Form;


use Blog\Entity\CategorieBlogEntity;
use Core\Form\AbstractForm;
use Core\Service\Utils;

class PostForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "blog/defalut",[
            'controller'=>"post",
            'action'=>'create'
        ]);

        $this->util = new Utils();

        $this->addText("name", "Nome\Descrição");
        $this->addText("preview","Descrição curta");
        $this->setRotulo("categorie", "Selecione Uma Categoria");
        $this->addObjectSelect("categorie",CategorieBlogEntity::class );
        $this->addHidden("views");
        $this->addHidden("cover");
        $this->addHidden("author");
        $this->addHidden("alias");
        $this->addTextArea("description","Descrição",['attributes'=>[
            'class'=>'form-control tiny_mce'
        ]]);

    }


}