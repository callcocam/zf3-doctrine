<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 23:15
 */

namespace Make;


use Admin\Table\Factory\FactoryTable;
use Make\Form\Factory\FactoryForm;
use Make\Service\Factory\FactorySevice;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

}