<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControleEstoque\Form;


use ControleEstoque\Entity\ProductEntity;
use Core\Form\AbstractForm;
use Core\Service\Utils;

class ProductForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "controle-estoque/defalut",[
            'controller'=>"product",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        $this->addText("name","Nome\Descrição");
        $this->addText("code","Codigo de barras");
        $this->addObjectSelect("parent",ProductEntity::class);
        $this->addText("preview","Descrição curta");
        $this->addHidden("cover");
        $this->addHidden("author");
        $this->addText("costs","Preço de custo");
        $this->get('costs')->setAttribute('class','form-control input-lg real');
        $this->addText("marge","Margem de lucro %");
        $this->get('marge')->setAttribute('class','form-control input-lg real');
        $this->addText("price","Preço de venda");
        $this->get('price')->setAttribute('class','form-control input-lg real');
        $this->addText("width","Largura(cm)");
        $this->addText("height","Altura(cm)");
        $this->addText("weight","Peso(Grama)");
        $this->addText("greeting","Comprimento(cm)");
        $this->addTextArea("description","Descrição",['attributes'=>[
            'class'=>'form-control tiny_mce'
        ]]);

    }


}