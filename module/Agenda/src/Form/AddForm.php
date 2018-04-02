<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace Agenda\Form;


use Admin\Entity\ClientEntity;
use Admin\Entity\UserEntity;
use Agenda\Entity\EventoEntity;
use Core\Form\AbstractForm;
use Core\Service\Utils;

class AddForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "agenda/defalut",[
            'controller'=>"agenda",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        $this->addText("title","Nome\Descrição");
        $this->addText("start","Inicio");
        $this->addText("end","Final");
        $this->setRotulo('categorie_id','Selecione Uma Categoria');
        $this->addObjectSelect("categorie_id",EventoEntity::class,'title');
        $this->setRotulo('client','Selecione Um Cliente');
        $this->addObjectSelect("client",ClientEntity::class,'name');
        $this->setRotulo('author','Selecione Um Responsavel');
        $this->addObjectSelect("author",UserEntity::class,'firstName');
        $this->addTextArea("description","Descrição",['attributes'=>[
            'class'=>'form-control tiny_mce'
        ]]);

    }


}