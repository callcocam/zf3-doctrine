<?php
/**
 * Created By: Claudio  Campos
 * E-Mail: callcocam@gmail.com
 */

namespace SIGAUpload;

use Zend\Router\Http\Literal;

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'router' => [
        'routes' => [
            // Literal route named "blog", with child routes
            'siga-upload' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/upload',
                    'defaults' => [
                        'controller' => 'SIGAUpload\Controller\Upload',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                     'default' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/index',
                            'defaults' => [
                                'action' => 'index',
                            ],
                        ],
                    ],
                    'upload-up' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/upload-up',
                            'defaults' => [
                                'action' => 'upload',
                            ],
                        ],
                    ],
                    'upload-save' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/upload-save',
                            'defaults' => [
                                'action' => 'save',
                            ],
                        ],
                    ],
                ],
            ],

            //GALLERIA
            'siga-galeria' => [
                'type' => 'literal',
                'options' => [
                    'route' => '/galeria',
                    'defaults' => [
                        'controller' => 'SIGAUpload\Controller\Galeria',
                        'action' => 'index',
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    // Segment route for viewing one blog post
                    'siga-galeria-preview' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/view',
                            'defaults' => [
                                'action' => 'preview',
                            ],
                        ],
                    ],
                    'siga-galeria-listar' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/galeria-listar',
                            'defaults' => [
                                'action' => 'listar',
                            ],
                        ],
                    ],
                    'galeria-save' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/galeria-save',
                            'defaults' => [
                                'action' => 'save',
                            ],
                        ],
                    ],
                    'galeria-create' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/galeria-create[/:id]',
                            'defaults' => [
                                'action' => 'create',
                            ],
                        ],
                    ],
                    'galeria-remove' => [
                        'type' => 'segment',
                        'options' => [
                            'route' => '/galeria-remove[/:id]',
                            'defaults' => [
                                'action' => 'remove',
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
        ]
    ]
];
