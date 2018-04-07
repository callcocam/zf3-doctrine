<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 16/02/2018
 * Time: 00:39
 */

namespace Core\HtmlElement\View\Helper\Service;


use Core\HtmlElement\View\Helper\HtmlElement;
use Zend\View\Helper\AbstractHelper;

class ActionsElement extends AbstractHelper
{

    protected $html = [];

    /**
     * @param string $label
     * @param string $icone
     * @return $this
     */
    public function delete($url,$label='Remover', $icone="fa fa-trash"){
        $this->html[] = $this->view->partial(sprintf('layout/%s/partial/delete', LAYOUT), [
            'label' =>  $label,
            'icone' =>  $icone,
            'url' =>  $url,
        ]);
        return $this;
    }

    /**
     * @param string $label
     * @param string $icone
     * @return $this
     */
    public function delete_gallery($url,$label='Remover', $icone="fa fa-trash"){
        $this->html[] = $this->view->partial(sprintf('layout/%s/partial/delete-galeria', LAYOUT), [
            'label' =>  $label,
            'icone' =>  $icone,
            'url' =>  $url,
        ]);
        return $this;
    }

    /**
     * @param string $label
     * @param string $icone
     * @return $this
     */
    public function save_gallery($label='Enviar', $icone="fa fa-upload"){
        $this->html[] = $this->view->partial(sprintf('layout/%s/partial/save-gallery', LAYOUT), [
            'label' =>  $label,
            'icone' =>  $icone
        ]);
        return $this;
    }
    /**
     * @param string $label
     * @param string $icone
     * @return $this
     */
    public function save($label='Salvar', $icone="fa fa-save"){
        $this->html[] = $this->view->partial(sprintf('layout/%s/partial/modal-save', LAYOUT), [
            'label' =>  $label,
            'icone' =>  $icone,
        ]);
        return $this;
    }

    public function dismiss($label="Fechar", $icone="fa fa-close"){
        $this->html[] = $this->view->partial(sprintf('layout/%s/partial/dismiss', LAYOUT), [
            'label' =>  $label,
            'icone' =>  $icone
        ]);
        return $this;
    }

    public function logar($class='3'){
        $this->html[] = $this->view->html('div')->setClass(sprintf("col-md-%s", $class))->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/submit', LAYOUT), [
                'element' =>  $this->view->form->get('submit')->setValue('Iniciar Sessão'),
                'ico' => 'fa fa-unlock',
                'title' => 'Iniciar Sessão',
            ])
        );
        return $this;
    }

    public function upload($class='3'){
        $this->html[] = $this->view->html('div')->setClass(sprintf("col-md-%s", $class))->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/upload', LAYOUT), [
                'element' =>  $this->view->form->get('submit')->setValue('Enviar Imagem'),
                'ico' => 'fa fa-upload',
                'title' => 'Enviar Imagem ou arquivo',
            ])
        );
        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function submit($class='3'){
        $this->html[] = $this->view->html('div')->setClass(sprintf("col-md-%s", $class))->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/submit', LAYOUT), [
                'element' =>  $this->view->form->get('submit')->setValue('Atualizar\Dados'),
                'ico' => 'fa fa-refresh',
                'title' => 'Atualizar O Dados',
            ])
        );
        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function save_copy($class='3'){
        $this->html[] = $this->view->html('div')->setClass(sprintf("col-md-%s", $class))->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/submit', LAYOUT), [
                'element' =>  $this->view->form->get('save_copy')->setValue('Atualizar\Duplicar'),
                'ico' => 'fa fa-clone',
                'title' => 'Atualizar  E Duplicar',
            ])
        );
        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function save_close($class='3'){
        $this->html[] = $this->view->html('div')->setClass(sprintf("col-md-%s", $class))->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/submit', LAYOUT), [
                'element' =>  $this->view->form->get('save_close')->setValue('Atualizar\Fechar'),
                'ico' => 'fa fa-close',
                'title' => 'Atualizar  E Fechar',
            ])
        );
        return $this;
    }
    /**
     * @param string $class
     * @return $this
     */
    public function btn_print($class='3'){

        $this->html[] = $this->view->html('div')->setClass(sprintf("col-md-%s", $class))->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/btn', LAYOUT), [
                'attrs' => [
                    "href"=> $this->view->url(sprintf("%s/default", $this->view->route), [
                        'controller' => $this->view->controller,
                        'action' => 'print',
                        'id' => $this->view->form->get('id')->getValue(),
                    ]),
                    'title' => 'Imprimir',
                    'class' => 'btn btn-default btn-block btn-flat',
                    'target' => '_blank'
                ] ,
                'icone'=>'fa fa-print',
                'rotulo'=>'Imprimir'
            ])
        );
        return $this;
    }

    /**
     * @param string $class
     * @return $this
     */
    public function back($class='3'){
        $this->html[] =  $this->view->html('div')->setClass(sprintf("col-md-%s", $class))->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/btn-voltar', LAYOUT), [
                'route' =>  $this->view->route,
                'controller' => $this->view->controller,
                'title' => 'Voltar Para A Lista',
            ])
        );
        return $this;
    }




    public function render(HtmlElement $element)
    {
        $element->setText(
        //ADD COLUNA A LINHA 02
            implode(PHP_EOL, $this->html)
        )->appendText($this->view->html('div')->setClass('clear'));
        $this->html=[];
        return $element->render();
    }

}