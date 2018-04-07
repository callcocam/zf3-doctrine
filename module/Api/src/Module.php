<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 26/03/2018
 * Time: 23:04
 */

namespace Api;


use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{


    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__.'/../config/module.config.php';
    }


}