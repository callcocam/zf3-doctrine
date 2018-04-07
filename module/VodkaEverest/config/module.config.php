<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace VodkaEverest;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use VodkaEverest\Controller\Factory\FactoryController;
use Zend\Router\Http\Literal;
return [
    'router' => [
        'routes' => [
            "vodka-everest" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "index",
                    ],
                ],
                "may_terminate" => true,
                "child_routes" => [
                    "default" => [
                        "type" => "Segment",
                        "options" => [
                            "route" => "/[:controller[/:action[/:id]]]",
                            "constraints" => [
                                "controller" => "[a-zA-Z][a-zA-Z0-9_-]*",
                                "action" => "[a-zA-Z][a-zA-Z0-9_-]*",
                            ],
                            "defaults" => [
                            ],
                        ],
                    ],

                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => include __DIR__ . "/controller.service.php",
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ]
];
