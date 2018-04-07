<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */
namespace ControlDeEstoque\Form;


use Core\Form\AbstractForm;
use Core\Service\Utils;
use ControlDeEstoque\Entity\CategoriaEntity;
use ControlDeEstoque\Entity\MarcaEntity;
use ControlDeEstoque\Entity\ProdutoEntity;

class ProdutoForm extends AbstractForm
{

    public function __construct($name = null, array $options = [])
    {
        parent::__construct($name, $options);
        $this->setAttribute('action', "controle-estoque/defalut",[
            'controller'=>"produto",
            'action'=>'create'
        ]);

        $this->util = new Utils();
        $this->addText("name","Nome\Descrição");
        $this->addText("code","Codigo de barras");
        $this->addObjectSelect("parent",ProdutoEntity::class);
        $this->addObjectSelect("categorie",CategoriaEntity::class);
        $this->addObjectSelect("brand",MarcaEntity::class);
        $this->addText("preview","Descrição curta");
        $this->addHidden("cover");
        $this->addHidden("author");
        $this->addHidden("alias");
        $this->addHidden("tags");
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