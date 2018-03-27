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

class TabElement extends AbstractHelper
{

    private $html = [];
    private $navs = [];
    private $navId = 1;
    private $navActive = "active";
    private $tabId = 1;
    private $tabActive = "active";

    protected $infoIco = 'fa fa-th';
    protected $infoTitle = 'Manutenção do Registro';

    /**
     * @param string $infoIco
     * @return TabElement
     */
    public function setInfoIco($infoIco)
    {
        $this->infoIco = $infoIco;
        return $this;
    }

    /**
     * @param string $infoTitle
     * @return TabElement
     */
    public function setInfoTitle($infoTitle)
    {
        $this->infoTitle = $infoTitle;
        return $this;
    }


    public function nav($title){
        $this->navs[] =  $this->view->html('li')->setClass($this->navActive)->setText(
            $this->view->html('a')->setAttributes([
                'href'=>sprintf("#tab-%s", $this->navId),
                'data-toggle'=>'tab',
            ])->setText($title)
        );
        $this->navId++;
        $this->navActive = "";
        return $this;
    }
    public function tabPanel($conteudo){
        $this->html[] =  $this->view->html('div')->setClass('tab-pane')->appendClass($this->tabActive)->setId(sprintf("tab-%s", $this->tabId))->setText(
            $this->view->html('div')->setClass('panel panel-default')->setText(
                $this->view->html('div')->setClass('panel-body')->setText($conteudo)
            )
        );
        $this->tabId++;
        $this->tabActive = "";
        return $this;
    }
    /**<div class="panel panel-default">
    <div class="panel-body">
     * @param HtmlElement $element
     * @return string
     */
    public function render(HtmlElement $element)
    {
        $element->setText($this->view->html('div')->setClass("nav-tabs-custom")->setText(
            $this->view->html('ul')->setClass('nav nav-tabs')->setText(
                implode(PHP_EOL, $this->navs)
            )->appendText(
                $this->view->html('li')->setClass('pull-right header')->setText(
                    $this->view->html('i')->setClass($this->infoIco)
                )->appendText($this->infoTitle)
            )
        )->appendText(
            $this->view->html('div')->setClass('tab-content')->setText(
                  implode(PHP_EOL, $this->html)
            )
        )
        );
        $this->navId = 1;
        $this->navActive = "active";
        $this->tabId = 1;
        $this->tabActive = "active";
        return $element->render();
    }

    public function person($action)
    {

        $Params = [
            'controller'=>$this->controller,
            'action'=>$action,
            'id'=>$this->view->Route()->getId(),
        ];

        $Rota = $this->view->url(sprintf('%s/default', $this->route),array_filter($Params),[
            'query'=>array_filter($this->query)
        ]);
        $this->inlineScript->captureStart();
        echo "$('#{$this->container}').zfTable('{$Rota}');";
        $this->inlineScript->captureEnd();
    }

}