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

class ButtonElement extends AbstractHelper
{

    protected $html = [];
    protected $attrs = [];
    /**
     * @var $field
     */
    protected $field;

    public function button($btn){
        $this->html[] = $this->view->html('button')->setAttributes($this->attrs)->setText(
            $this->view->html('span')->setClass($this->view->form->get($btn)->getAttribute('icon'))
        )->appendText($this->translate($this->view->form->get($btn)->getLabel())
        );
    }
    public function render(HtmlElement $element)
    {
        $element->setText($this->view->html('div')->setClass("input-group input-group-lg")->setText(
            $this->view->html('div')->setClass('input-group-btn')->setAttributes([
                'style'=>'top: 12px;'
            ])->setText(
                implode(PHP_EOL, $this->html)
            )->appendText($this->view->html('div')->setClass('icon')->setText($this->view->html('i')->setClass('ion ion-bag')))
                ->appendText($this->view->html('a')->setClass('small-box-footer')->setText('More info')
                    ->appendText($this->view->html('i')->setClass('fa fa-arrow-circle-right')))
        ));
        return $element->render();
    }

}
