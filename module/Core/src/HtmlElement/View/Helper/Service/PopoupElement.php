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
use Zend\View\Helper\HeadLink;
use Zend\View\Helper\InlineScript;

class PopoupElement extends AbstractHelper
{

    protected $html = [];
    /**
     * @var string $type
     */
    protected $type = "button";

    /**
     * @var string $title
     */
    protected $title = "Adicionar";

    /**
     * @var string $container
     */
    protected $container = "geralContainer";

    /**
     * @var string $controller
     */
    protected $controller = "admin";

    /**
     * @var string $action
     */
    protected $action = "add";

    /**
     * @var string $class
     */
    protected $class = "btn btn-primary btn-block margin-bottom modal-add";
    /**
     * @var array $query
     */
    protected $query = [];

    /**
     * @var string $route
     */
    protected $route = "admin";

    /**
     * @param string $type
     * @return PopoupElement
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $title
     * @return PopoupElement
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $container
     * @return PopoupElement
     */
    public function setContainer($container)
    {
        $this->container = $container;
        return $this;
    }

    /**
     * @param string $controller
     * @return PopoupElement
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param string $action
     * @return PopoupElement
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param string $class
     * @return PopoupElement
     */
    public function setClass($class)
    {
        $this->class = $class;
        return $this;
    }

    /**
     * @param array $query
     * @return PopoupElement
     */
    public function setQuery($query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @param string $route
     * @return PopoupElement
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    private $inlineScript;
    private $headLink;
    public function __construct(InlineScript $inlineScript,HeadLink $headLink)
    {

        $this->inlineScript   = $inlineScript;
        $this->headLink=$headLink;

    }

    /**
     * @param HtmlElement $element
     * @return string
     */
    public function render(HtmlElement $element)
    {
        $element->setText(
            $this->view->html('div')->setClass('col-md-12')->setText(
                $this->view->html('button')->setAttributes([
                    'type'=>$this->type,
                    'class'=> $this->class,
                    'data-container'=>"#{$this->container}",
                    'data-url'=>$this->view->url(sprintf('%s/default', $this->route),[
                        'controller'=>$this->controller,
                        'action'=>$this->action,
                        'id'=>'id',
                    ],[
                        'query'=>array_filter($this->query)
                    ]),
                ])->setText(
                    $this->view->html('i')->setClass('fa fa-plus')
                )->appendText(" {$this->title}")
            )->appendText(
                $this->person('listar')
            )->appendText(
                $this->view->html('div')->setClass('table-responsive mailbox-messages')->setText(
                    $this->view->html('div')->setId($this->container)
                )
            )

        );
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