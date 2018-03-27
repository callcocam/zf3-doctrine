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

class ModalElement extends AbstractHelper
{

    /**
     * @var array $html
     */
    protected $html = [];
    /**
     * @var $header
     */
    protected $header = '';
    /**
     * @var $close_top
     */
    protected $close_top = "";
    /**
     * @var $close_footer
     */
    protected $close_footer = "";

    /**
     * @var string $save
     */
    protected $save = "";
    /**
     * @var $footer
     */
    protected $footer;
    /**
     * @var HeadLink $headLink
     */
    protected $headLink;
    /**
     * @var InlineScript $inlineScript
     */
    protected $inlineScript;



    public function __construct(InlineScript $inlineScript,HeadLink $headLink)
    {

        $this->inlineScript   = $inlineScript;
        $this->headLink=$headLink;

    }

    /**
     * @return ModalElement
     */
    public function setCloseTop()
    {
        $this->close_top = $this->view->html('button')->setAttributes([
            'type'=> 'button',
            'class'=> 'close',
            'data-dismiss'=> 'modal',
            'aria-label'=> $this->view->translate('Close')
        ])->setText( $this->view->html('span')->setAttributes([
            'aria-hidden'=> 'true'
        ])->setText('&times;'));
        return $this;
    }

    /**
     * @param array $html
     * @return ModalElement
     */
    public function setHtml($html)
    {
        $this->html[] = $html;
        return $this;
    }

    /**
     * @param mixed $header
     * @return ModalElement
     */
    public function setHeader($header)
    {
        $this->header = $this->view->html('div')
            ->setClass('modal-header')
            ->setText($this->close_top)->appendText(
                $this->view->html('h4')->setClass('modal-title')->setText($header));
        return $this;
    }

    /**
     * @param mixed $close_footer
     * @return ModalElement
     */
    public function setCloseFooter($close_footer="Close")
    {
        $this->close_footer = $this->view->html('button')->setAttributes([
            'type'=> 'button',
            'class'=> 'btn btn-danger btn-flat  pull-left',
            'data-dismiss'=> 'modal'
        ])->setText( $this->view->html('span')->setClass('fa fa-close')->setText($this->view->translate($close_footer)));
        return $this;
    }

    /**
     * @param string $save
     * @return ModalElement
     */
    public function setSave($save="Save")
    {
        $this->save = $this->view->html('button')->setAttributes([
            'type'=> 'submit',
            'class'=> 'btn btn-success btn-flat'
        ])->setText( $this->view->html('span')->setClass('fa fa-refresh')->setText($this->view->translate($save)));
        return $this;
    }


    /**
     * @return ModalElement
     */
    public function setFooter()
    {
        $this->footer = $this->view->html('div')->setClass('modal-footer')->setText($this->close_footer)->appendText($this->save);
        return $this;
    }




    /**
     * @param HtmlElement $element
     * @return string
     */
    public function render(HtmlElement $element)
    {
        $element->setText(
            $this->view->html('div')->setClass('modal-content')
                ->setText($this->header)
                ->appendText($this->view->html('div')->setClass('modal-body')->setText(implode(PHP_EOL, $this->html)))
                ->appendText($this->footer)

        );
        return $element->render();
    }


}