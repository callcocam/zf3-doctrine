<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 18/03/2018
 * Time: 11:57
 */

namespace Core\Service;



use Zend\Mvc\Plugin\FlashMessenger\FlashMessenger;

class Messages extends FlashMessenger
{

    public function addRedirect($url, $hops = 1)
    {
        return parent::addMessage($url, "redirect", $hops);
    }
    public function addTime($Time, $hops = 1)
    {
        return parent::addMessage($Time, "time", $hops);
    }

}