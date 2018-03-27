<?php
namespace Register;
use Api\Controller\Factory\FactoryController;
use Zend\Router\Http\Segment;

return [

    'router' => [
        'routes' => [
            "api-register" => [
                'type' => Segment::class,
                'options' => [
                    'route' => '/api/register[/:id]',
                    'constraints' => [
                        'id' => '[0-9]+',
                    ],
                    'defaults' => [
                        'controller' => Controller\RegisterController::class,
                        'isAuthorizationRequired' => true,
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            "Register\Controller\RegisterController" => FactoryController::class,
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ]
    ],
];