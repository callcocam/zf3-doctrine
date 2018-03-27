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

class BoxElement extends AbstractHelper
{

    protected $html = [];

    public function render(HtmlElement $element)
    {
        $element->setText($this->view->html('div')->setClass("col-lg-3 col-md-6 col-xs-12")->setText(
            $this->view->html('div')->setClass('small-box bg-aqua')->setText(
                $this->view->html('div')->setClass('inner')->setText(
                    $this->view->html('h3')->setText(150)
                )->appendText($this->view->html('p')->setText('New Orders'))
            )->appendText($this->view->html('div')->setClass('icon')->setText($this->view->html('i')->setClass('ion ion-bag')))
                ->appendText($this->view->html('a')->setClass('small-box-footer')->setText('More info')
                    ->appendText($this->view->html('i')->setClass('fa fa-arrow-circle-right')))
        ));
        return $element->render();
    }

}