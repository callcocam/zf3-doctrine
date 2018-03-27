<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 26/03/2018
 * Time: 11:31
 */

namespace Core\Mail;


interface MailInterface
{
    public function setSubject($subject);
    public function setTo($to);
    public function setData($data);
    public function setViewTemplate($viewTemplate);
    public function execute();
    public function send();
}