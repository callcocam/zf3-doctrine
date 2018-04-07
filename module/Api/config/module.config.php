<?php
namespace Api;
use Zend\Router\Http\Segment;

return [
    'ApiRequest' => [
        'responseFormat' => [
            'statusKey' => 'status',
            'statusOkText' => 'OK',
            'statusNokText' => 'NOK',
            'resultKey' => 'result',
            'messageKey' => 'message',
            'defaultMessageText' => 'Empty response!',
            'errorKey' => 'error',
            'defaultErrorText' => 'Unknown request!',
            'authenticationRequireText' => 'Authentication Required.',
            'pageNotFoundKey' => 'Request Not Found.',
        ],
        'jwtAuth' => [
            'cypherKey' => 'R1a#2%dY2fX@3g8r5&s4Kf6*sd(5dHs!5gD4s',
            'tokenAlgorithm' => 'HS256',
        ],
    ],
    'router' => [
        'routes' => [
            'api-auth' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/api/auth[/:id]',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'isAuthorizationRequired' => false,
                    ],
                ],
            ],
            'api-empresa' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/api/empresa[/:id]',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\EmpresaController::class,
                        'isAuthorizationRequired' => false,
                    ],
                ],
            ],
            'api-post' => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/api/post[/:id]',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\PostController::class,
                        'isAuthorizationRequired' => true,
                    ],
                ],
            ],

        ],
    ],
    'controllers' => [
        'factories' => [
            Controller\AuthController::class => Controller\Factory\FactoryController::class,
            Controller\EmpresaController::class => Controller\Factory\FactoryController::class,
            Controller\PostController::class => Controller\Factory\FactoryController::class,
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ]
    ],

];