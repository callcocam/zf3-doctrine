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
use Zend\Router\Http\Segment;

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
            "imprensa" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/imprensa",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "imprensa",
                    ],
                ],
            ],
            "drinks" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/drinks",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "drinks",
                    ],
                ],
            ],
            "novidades-eventos" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/novidades-eventos",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "novidades-eventos",
                    ],
                ],
            ],
            "contato" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/contato",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "contato",
                    ],
                ],
            ],
            "politica-de-privacidade" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/politica-de-privacidade",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "politica-de-privacidade",
                    ],
                ],
            ],
            "termos-de-uso" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/termos-de-uso",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "termos-de-uso",
                    ],
                ],
            ],
            "declaracao-de-responsabilidade" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/declaracao-de-responsabilidade",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "declaracao-de-responsabilidade",
                    ],
                ],
            ],
            "sobre-nos" => [
                "type" => Literal::class,
                "options" => [
                    "route" => "/sobre-nos",
                    "defaults" => [
                        "__NAMESPACE__" => "VodkaEverest\Controller",
                        "controller" => "Start",
                        "action" => "sobre-nos",
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
