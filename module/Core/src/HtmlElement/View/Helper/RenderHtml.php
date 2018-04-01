<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 27/03/2018
 * Time: 17:57
 */

namespace Core\HtmlElement\View\Helper;


use Zend\View\Helper\AbstractHelper;

class RenderHtml extends AbstractHelper
{
    private $row;

    /**
     * @param $row
     */
    public function row($row){

        $this->row[] =  $this->view->partial(sprintf("layout/%s/partial/tab/link", LAYOUT),[
            'title'=>$title,
            'href'=>sprintf("#tab-%s", $this->navId)
        ]);
    }
}