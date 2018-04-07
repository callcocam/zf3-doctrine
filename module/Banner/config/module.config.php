<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Banner;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Router\Http\Literal;
return [
    'router' => [
        'routes' => [
            "banner" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/banner",
                    "defaults" => [
                        "__NAMESPACE__" => "Banner\Controller",
                        "controller" => "Banner",
                        "action" => "index",
                    ],
                ],
            ],
            "adm-banner" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/admin/banner",
                    "defaults" => [
                        "__NAMESPACE__" => "Banner\Controller",
                        "controller" => "Banner",
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
