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

class InputElement extends AbstractHelper
{

    /**
     * @var array $html
     */
    protected $html = [];

    /**
     * @var string $formLayouty
     */
    protected $formLayouty = "group";
    /**
     * @var $class
     */
    protected $class = 'col-md-12';
    /**
     * @var string $partialExtra
     */
    protected $partialExtra = "";
    /**
     * @var $Select
     */
    protected $Select;
    /**
     * @var null $filtro
     */
    protected $filtro = null;
    /**
     * @var string $id
     */
    protected $id = "id";

    protected $addLabel="";
    protected $btn = "";

    /**
     * @param string $formLayouty
     * @return InputElement
     */
    public function setFormLayouty($formLayouty)
    {
        $this->formLayouty = $formLayouty;
        return $this;
    }

    /**
     * @param mixed $class
     * @return InputElement
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @param string $partialExtra
     * @return InputElement
     */
    public function setPartialExtra($partialExtra)
    {
        $this->partialExtra = $partialExtra;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSelect()
    {
        return $this->Select;
    }

    /**
     * @param null $filtro
     * @return InputElement
     */
    public function setFiltro($filtro)
    {
        $this->filtro = $filtro;
        return $this;
    }

    /**
     * @param string $id
     * @return InputElement
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param string $addLabel
     * @return InputElement
     */
    public function setAddLabel($addLabel)
    {
        $this->addLabel = $addLabel;
        return $this;
    }


  public function setBtn($btn){
        $this->btn = $btn;
        return $this;
  }

    /**
     * @param $field
     * @return $this
     */
    public function label($field){
        $this->html[] =  $this->view->html('div')->setClass($this->class)->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/label-%s', LAYOUT,$this->formLayouty),[
                'field'=>$this->view->form->get($field)
            ])
        );
        return $this;
    }

    /**
     * @param $field
     * @param $route
     * @param $controller
     * @param $id
     * @param string $action
     * @return $this
     */
    public function editor($field,$route, $controller, $id, $action='upload-mce'){
        $this->html[] =  $this->view->html('div')->setClass($this->class)->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/editor-%s%s', LAYOUT,$this->formLayouty, $this->partialExtra),[
                'field'=>$this->view->form->get($field),
                'route'=>$route,
                'action'=>$action,
                'controller'=>$controller,
                'id'=>$id,
            ])
        );
        return $this;
    }
    /**
     * @param $field
     * @return $this
     */
    public function input($field){
        $this->html[] =  $this->view->html('div')->setClass($this->class)->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/input-%s%s', LAYOUT,$this->formLayouty, $this->partialExtra),[
                'field'=>$this->view->form->get($field),
                'btn'=>$this->btn
            ])
        );
        return $this;
    }
    /**
     * @param $field
     * @return $this
     */
    public function clear($field){
        $this->html[] =
            $this->view->partial(sprintf('layout/%s/partial/form/input-%s%s', LAYOUT,$this->formLayouty, $this->partialExtra),[
                'field'=>$this->view->form->get($field),
                'btn'=>$this->btn
            ]);
        return $this;
    }
    /**
     * @param $field
     * @return $this
     */
    public function statusSelect($field){
        $this->html[] =  $this->view->html('div')->setClass($this->class)->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/input-%s%s', LAYOUT,$this->formLayouty, $this->partialExtra),[
                'field'=>$this->view->form->statusSelect($field)->get($field),
            ])
        );
        return $this;
    }
    /**
     * @param $field
     * @return $this
     */
    public function status($field, $T=false){
        $this->html[] =  $this->view->html('div')->setClass($this->class)->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/input-%s%s', LAYOUT,$this->formLayouty, $this->partialExtra),[
                'field'=>$this->view->form->status($field,$T)->get($field),
            ])
        );
        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function dataValidate($field, $validate,$class=false){
        $this->html[] =  $this->view->html('div')->setClass($this->class)->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/input-%s%s', LAYOUT,$this->formLayouty, $this->partialExtra),[
                'field'=>$this->view->form->dataValidate($field,$validate,$class)->get($field),
            ])
        );
        return $this;
    }
    /**
     * @param $field
     * @return $this
     */
    public function dataValidateSelect($field, $validate){
        $this->html[] =  $this->view->html('div')->setClass($this->class)->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/input-%s%s', LAYOUT,$this->formLayouty, $this->partialExtra),[
                'field'=>$this->view->form->dataValidateSelect($field,$validate)->get($field),
            ])
        );
        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function timepicker($field, $T=false){
        $this->html[] =  $this->view->html('div')->setClass($this->class)->appendClass('col-xs-12')->setText(
            $this->view->partial(sprintf('layout/%s/partial/form/timepicker-%s%s', LAYOUT,$this->formLayouty, $this->partialExtra),[
                'field'=>$this->view->form->dataValidate($field,$field, $T)->get($field),
            ])
        );
        return $this;
    }


    /**
     * @param $field
     * @return $this
     */
    public function file($field = "cover"){
        $this->html[] =  $this->view->partial(sprintf('layout/%s/partial/form/input-file', LAYOUT,$this->formLayouty),[
            'field'=>$this->view->form->get($field),
            'route'=>$this->view->route,
            'controller'=>$this->view->controller,
            'id'=>$this->view->form->get('id')->getValue(),
            'action'=>'upload-modal',
        ]);
        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function hidden($field){
        $this->html[] =  $this->view->formHidden($this->view->form->get($field));
        return $this;
    }

    /**
     * @param array $html
     * @return InputElement
     */
    public function setHtml($html)
    {
        $this->html[] = $html;
        return $this;
    }


    public function render(HtmlElement $element)
    {
        $element->setText(
        //ADD COLUNA A LINHA 02
            implode(PHP_EOL, $this->html)
        )->appendText($this->view->html('div')->setClass('clear'));
        $this->html = [];
        $this->class = 'col-md-12';
        return $element->render();
    }

}