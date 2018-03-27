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

class GalleryElement extends AbstractHelper
{

    protected $html = [];
    /**
     * @var string $type
     */
    protected $type = "file";

    /**
     * @var string $title
     */
    protected $title = "Selecione imagens para a galeria!";

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
     * @var string $route
     */
    protected $route = "admin";

    /**
     * @var string $Selector
     */
    protected $Selector = '#gallery';
    /**
     * @var string $id
     */
    protected $id = "gallery";

    /**
     * @var $name
     */
    protected $name = 'file[]';


    /**
     * @var InlineScript $inlineScript
     */
    private $inlineScript;
    /**
     * @var HeadLink $headLink
     */
    private $headLink;
    /**
     * @var $multiple
     */
    private $multiple = true;

    /**
     * @param string $type
     * @return GalleryElement
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param string $title
     * @return GalleryElement
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $controller
     * @return GalleryElement
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param string $action
     * @return GalleryElement
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param string $route
     * @return GalleryElement
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @param string $Selector
     * @return GalleryElement
     */
    public function setSelector($Selector)
    {
        $this->Selector = $Selector;
        return $this;
    }

    /**
     * @param string $id
     * @return GalleryElement
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $name
     * @return GalleryElement
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }



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
                $this->view->html('label')->setAttributes([
                    'for'=> $this->id
                ])->setText($this->title)
            )->appendText(
                $this->view->html('div')->setClass('file-loading')->setText(
                    $this->view->html('input')->setAttributes([
                        'id'=>$this->id,
                        'name'=> $this->name ,
                        'type'=> $this->type,
                        'multiple'=>$this->multiple,
                    ])
                )
            )
        )->appendText($this->preview());
        return $element->render();
    }

    public function preview()
    {

        $this->inlineScript->captureStart();
        echo $this->view->partial('layout/%s/partial/gallery-preview',[
            'route'=>$this->route,
            'controller'=>$this->controller,
            'Selector'=>$this->Selector
        ]);
        $this->inlineScript->captureEnd();
    }


}