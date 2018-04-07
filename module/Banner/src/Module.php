<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 11:34
 */

namespace Banner;


class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }
}