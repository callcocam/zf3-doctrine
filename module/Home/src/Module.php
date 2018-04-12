<?php
/**
 * Created by PhpStorm.
 * User: caltj
 * Date: 17/03/2018
 * Time: 11:34
 */

namespace Home;


use Home\View\Helper\BannerHelper;
use Interop\Container\ContainerInterface;

class Module
{
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Expected to return \Zend\ServiceManager\Config object or array to
     * seed such an object.
     *
     * @return array|\Zend\ServiceManager\Config
     */
    public function getViewHelperConfig()
    {
        return [
            'factories'=>[
                "Banner" => function (ContainerInterface $container) {
                    $viewHelper = new BannerHelper($container);
                    return $viewHelper;
                }
            ],
            'invokables' => [

            ],
        ];

    }
}