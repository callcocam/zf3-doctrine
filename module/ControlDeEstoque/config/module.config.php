<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace ControlDeEstoque;

use Zend\Router\Http\Literal;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
return [
    'router' => [
        'routes' => [
            "controle-estoque" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/controle-estoque",
                    "defaults" => [
                        "__NAMESPACE__" => "ControlDeEstoque\Controller",
                        "controller" => "ControleEstoque",
                        "action" => "index",
                    ],
                ],
            ],
            "adm-controle-estoque" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/controle-estoque",
                    "defaults" => [
                        "__NAMESPACE__" => "ControlDeEstoque\Controller",
                        "controller" => "ControleEstoque",
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
        'factories' => include __DIR__."/controller.service.php",
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
