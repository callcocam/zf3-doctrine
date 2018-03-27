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

class AddonElement extends AbstractHelper
{

    /**
     * @var array $html
     */
    protected $html = [];
    /**
     * @var array $attrs
     */
    protected $attrs = ['type'=>'button', 'class'=>'btn btn-default opem-poupop-add'];
    /**
     * @var string $icon
     */
    protected $icon = 'glyphicon glyphicon-plus';

    /**
     * @var string $appenClass
     */
    protected $appenClass = "input-group-lg";
    /**
     * @var $field
     */
    protected $field;

    /**
     * @param array $attrs
     * @return AddonElement
     */
    public function setAttrs($attrs)
    {
        $this->attrs = $attrs;
        return $this;
    }

    /**
     * @param string $icon
     * @return AddonElement
     */
    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    /**
     * @param string $appenClass
     * @return AddonElement
     */
    public function setAppenClass($appenClass)
    {
        $this->appenClass = $appenClass;
        return $this;
    }

    /**
     * @param mixed $field
     * @return AddonElement
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }


    public function button($attrs =[]){
        $this->html[] = $this->view->html('button')->setAttributes(array_merge($this->attrs,$attrs))->setText(
            $this->view->html('span')->setClass($this->icon)
        );
        return $this;
    }
    public function render(HtmlElement $element)
    {
        $Label = $this->field->getLabel();
        $element->setText(
            $this->view->html('div')->setAttributes(['style'=>'top: 13px;'])->setClass("input-group-btn")->setText(
                implode(PHP_EOL, $this->html)
            ))->appendText(
                $this->view->html('label')->setAttributes([
                    'for'=>$this->field->getAttribute('id')
                ])->setText($Label)
        )->appendText(
            $this->view->formRow($this->field->setLabel("")->setAttributes([
                'aria-label'=>'Text input with multiple buttons'
            ]))
        )->setClass("input-group")->appendClass($this->appenClass);
        $this->html=[];
        return $element->render();
    }

}
