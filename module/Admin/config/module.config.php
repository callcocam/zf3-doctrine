<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Admin;

use Admin\Controller\Factory\FactoryController;
use Zend\Router\Http\Literal;
use Zend\ServiceManager\Factory\InvokableFactory;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
            "admin" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/admin",
                    "defaults" => [
                        "__NAMESPACE__" => "Admin\Controller",
                        "controller" => "Admin",
                        "action" => "index",
                    ],
                ],
            ],
            "adm-config" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/admin/config",
                    "defaults" => [
                        "__NAMESPACE__" => "Admin\Controller",
                        "controller" => "Config",
                        "action" => "index",
                    ],
                ],
            ],

            "adm-admin" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/admin",
                    "defaults" => [
                        "__NAMESPACE__" => "Admin\Controller",
                        "controller" => "Admin",
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
        'display_not_found_reason' => true,
        'display_exceptions' => true,
        'doctype' => 'HTML5',
        'not_found_template' => 'error/404',
        'exception_template' => 'error/index',
        'template_map' => [
            'layout/layout' => __DIR__ . '/../view/layout/admin.phtml',
            'admin/index/index' => __DIR__ . '/../view/admin/index/index.phtml',
            'error/404' => __DIR__ . '/../view/error/404.phtml',
            'error/index' => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
    'doctrine' => [
        'driver' => [
            __NAMESPACE__ . '_driver' => [
                'class' => AnnotationDriver::class,
                'cache' => 'array',
                'paths' => [__DIR__ . '/../src/Entity']
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ . '\Entity' => __NAMESPACE__ . '_driver'
                ]
            ]
        ],
        'fixtures' => [
            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/Fixture',
        ]

    ]
];
