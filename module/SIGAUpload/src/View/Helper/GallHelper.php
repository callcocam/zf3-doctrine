<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 05/04/2018
 * Time: 13:52
 */

namespace SIGAUpload\View\Helper;


use Core\HtmlElement\View\Helper\HtmlElement;
use Zend\View\Helper\AbstractHelper;

class GallHelper extends AbstractHelper
{

    protected $html = [];

    /**
     * @var string $title
     */
    protected $title = "Selecione imagens para a galeria!";

    /**
     * @var string $title
     */
    protected $fomName = "AjaxGalleryForm";

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
    protected $Selector = 'gallery';
    /**
     * @var string $id
     */
    protected $id;

    /**
     * @var $name
     */
    protected $name = 'file[]';

    /**
     * @var $multiple
     */
    private $multiple = 'multiple';



    /**
     * @param string $title
     * @return GallHelper
     */
    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @param string $controller
     * @return GallHelper
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param string $action
     * @return GallHelper
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param string $route
     * @return GallHelper
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    /**
     * @param string $Selector
     * @return GallHelper
     */
    public function setSelector($Selector)
    {
        $this->Selector = $Selector;
        return $this;
    }

    /**
     * @param string $id
     * @return GallHelper
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @param mixed $name
     * @return GallHelper
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }


    /**
     * @param HtmlElement $element
     * @return string
     */
    public function render(HtmlElement $element)
    {
        $element->setText($this->view->render(sprintf('siga-upload/galeria/%s/gallery-upload', LAYOUT),[
            'title'=>$this->title,
            'route'=>$this->route,
            'controller'=>$this->controller,
            'Selector'=>$this->Selector,
            'id'=>$this->id,
            'name'=> $this->name,
            'fomName'=> $this->fomName,
            'multiple'=>$this->multiple
        ]))->appendText($this->preview());
        return $element->render();
    }

    public function preview()
    {
//        $this->view->inlineScript()->captureStart();
//        echo $this->view->partial(sprintf('layout/%s/partial/gallery-preview', LAYOUT),[
//            'route'=>$this->route,
//            'controller'=>$this->controller,
//            'Selector'=>$this->Selector
//        ]);
//        $this->view->inlineScript()->captureEnd();
    }


}