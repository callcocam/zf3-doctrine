<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Home;

use Home\Controller\Factory\FactoryController;
use Zend\Router\Http\Literal;
return [
    'router' => [
        'routes' => [
            "home" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/",
                    "defaults" => [
                        "__NAMESPACE__" => "Home\Controller",
                        "controller" => "Start",
                        "action" => "index",
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            "Home\Controller\Start" => FactoryController::class,
        ],
    ],
    'view_manager' => [
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/home.phtml',
            'home/index/index' => __DIR__ . '/../view/home/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
