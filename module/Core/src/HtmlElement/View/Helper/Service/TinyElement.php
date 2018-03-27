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

class TinyElement extends AbstractHelper
{

      /**
     * @var $field
     */
    protected $field;
    /**
     * @var string $action
     */
    protected $action = 'upload-mce';
    /**
     * @var $controller
     */
    protected $controller;
    /**
     * @var $route
     */
    protected $route;
    /**
     * @var InlineScript $inlineScript
     */
    protected $inlineScript;
    /**
     * @var HeadLink $headLink
     */
    protected $headLink;

    /**
     * @param mixed $field
     * @return TinyElement
     */
    public function setField($field)
    {
        $this->field = $field;
        return $this;
    }

    /**
     * @param string $action
     * @return TinyElement
     */
    public function setAction($action)
    {
        $this->action = $action;
        return $this;
    }

    /**
     * @param mixed $controller
     * @return TinyElement
     */
    public function setController($controller)
    {
        $this->controller = $controller;
        return $this;
    }

    /**
     * @param mixed $route
     * @return TinyElement
     */
    public function setRoute($route)
    {
        $this->route = $route;
        return $this;
    }

    public function __construct(InlineScript $inlineScript,HeadLink $headLink)
    {

        $this->inlineScript   = $inlineScript;
        $this->headLink=$headLink;

    }

    public function render(HtmlElement $element)
    {
        $element->setText(
                 $this->view->html('label')->setText($this->view->html($this->field->getLabel()))
        )->appendText(
            $this->view->formRow($this->field->setLabel(""))
        )->appendText($this->preview());

        return $element->render();
    }

    public function preview()
    {
        $Params = [
            'controller' => $this->controller,
            'action' => $this->action,
            'id' => $this->view->Route()->getId(),
        ];
        $Rota = $this->view->Url(sprintf("%s/default", $this->route), $Params);
        $this->inlineScript->prependFile('/admin-lte/plugins/tinymce/tiny_mce.init.js')
            ->prependFile('/admin-lte/plugins/tinymce/tinymce.min.js');
        $this->inlineScript->captureStart();
         echo  "$('#content').zfTiny('{$Rota}');";
        $this->inlineScript->captureEnd();
    }

}
