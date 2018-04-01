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
    private $navActive = " active";
    private $tabId = 1;
    private $tabActive = "active";
    private $navShow = "show";
    private $tabShow = "show";

    protected $infoIco = 'fa fa-th';
    protected $infoTitle = 'Manutenção do Registro';

    public function setNumber($Number=1)
    {
       $this->navId = $Number;
       $this->tabId = $Number;
       return $this;
    }

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
        $this->navs[] =  $this->view->partial(sprintf("layout/%s/partial/tab/link", LAYOUT),[
            'title'=>$title,
            'href'=>sprintf("#tab-%s", $this->navId),
            'active'=>$this->navActive,
            'show'=>$this->navShow,
        ]);
        $this->navId++;
        $this->navActive = "";
        $this->navShow = "";
        return $this;
    }

    /**
     * @param $conteudo
     * @return $this
     */
    public function tabPanel($conteudo){
        $this->html[] =  $this->view->partial(sprintf("layout/%s/partial/tab/content", LAYOUT),[
             'itemContent'=>$conteudo,
             'active'=>$this->tabActive,
             'id'=>$this->tabId,
            'show'=>$this->tabShow,
        ]);
        $this->tabId++;
        $this->tabShow = "";
        $this->tabActive = "";
        return $this;
    }

    /**
     * @return mixed
     */
    public function render()
    {
        $element = $this->view->partial(sprintf("layout/%s/partial/tab/tab", LAYOUT),[
            'infoTitle'=>$this->infoTitle,
            'link'=>implode(PHP_EOL, $this->navs),
            'tabContent'=> implode(PHP_EOL, $this->html)
        ]);
        $this->navId = 1;
        $this->navActive = "active";
        $this->tabId = 1;
        $this->tabActive = "active";
        return $element;
    }


}