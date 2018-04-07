<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace Blog;

use Zend\Router\Http\Literal;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
return [
    'router' => [
        'routes' => [
            "blog" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/blog",
                    "defaults" => [
                        "__NAMESPACE__" => "Blog\Controller",
                        "controller" => "Post",
                        "action" => "index",
                    ],
                ],
            ],
            "adm-blog" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/blog",
                    "defaults" => [
                        "__NAMESPACE__" => "Blog\Controller",
                        "controller" => "Post",
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
        ],
        'fixtures' => [
            __NAMESPACE__ . '_fixture' => __DIR__ . '/../src/Fixture',
        ]
    ]
];
