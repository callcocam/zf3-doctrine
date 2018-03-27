<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 20/03/2018
 * Time: 19:18
 */

namespace Core\View\Helper;


use Zend\View\Helper\AbstractHelper;

class DateHelper extends AbstractHelper
{

    public function SHORT($data){
        return $this->view->dateFormat(new \DateTime($data), \IntlDateFormatter::SHORT);
    }

    public function FULL($data){
        return $this->view->dateFormat(new \DateTime($data), \IntlDateFormatter::FULL);
    }

    public function LONG($data){
        return $this->view->dateFormat(new \DateTime($data), \IntlDateFormatter::LONG);
    }

}