<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 26/03/2018
 * Time: 11:43
 */

namespace Core\Mail;


interface TemplateInterface
{
    /**
     * @param string $mailTemplate mailtemplate.phtml
     * @param array $data data contents
     */
    public function render($mailTemplate, array $data);
    public function getFolderTemplate();
    public function setFolderTemplate($folderTemplate);
}