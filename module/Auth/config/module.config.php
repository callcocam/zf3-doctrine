<?php

/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Auth;

use Auth\Controller\Factory\ControllerFactoy;
use Zend\Router\Http\Literal;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
return [
    'router' => [
        'routes' => [
            "adm-auth" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/admin/auth",
                    "defaults" => [
                        "__NAMESPACE__" => "Auth\Controller",
                        "controller" => "Auth",
                        "action" => "login",
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
            "adm-auth-sair" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/admin/auth/sair",
                    "defaults" => [
                        "__NAMESPACE__" => "Auth\Controller",
                        "controller" => "Auth",
                        "action" => "sair",
                    ],
                ]
            ],

        ],
    ],
    'controllers' => [
        'factories' => [
            'Auth\Controller\Auth' => ControllerFactoy::class,
        ],
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
        ]
    ]
];
