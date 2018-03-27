<?php
/**
 * Global Configuration Override
 *
 * You can use this file for overriding configuration values from modules, etc.
 * You would place values in here that are agnostic to the environment and not
 * sensitive to security.
 *
 * @NOTE: In practice, this file will typically be INCLUDED in your source
 * control, so do not include passwords or other sensitive information in this
 * file.
 */

return [
    // Session configuration.
    'session_config' => [
        'cookie_lifetime' => 60 * 60 * 1, // Session cookie will expire in 1 hour.
        'gc_maxlifetime' => 60 * 60 * 24 * 30, // How long to store session data on server (for 1 month).
    ],
    // Session manager configuration.
    'session_manager' => [
        // Session validators (used for security).
        'validators' => [
            \Zend\Session\Validator\RemoteAddr::class,
            \Zend\Session\Validator\HttpUserAgent::class,
        ]
    ],
    // Session storage configuration.
    'session_storage' => [
        'type' => \Zend\Session\Storage\SessionArrayStorage::class
    ],
    'mime_types_custom' => [
        'ext-image-thumb' => [
            'jpg', 'jpeg', 'png', 'gif'
        ],
        'ext-image-min' => [
            'jpg', 'jpeg', 'png', 'gif', 'bmp', 'tif'
        ],
        'ext-audio-min' => [
            'mp3', 'wma'
        ],
        'ext-video-min' => [
            'mp4', 'flv', 'avi', 'wmv'
        ],
        'ext-application-min' => [
            'exe'
        ],
        'ext-ms-oficce' => [
            'xls', 'doc', 'ppt', 'docx', 'xlsx'
        ],
    ],
    'Log' => [
        'notificationMail' => [
            'notify' => false,
            'priorities' => [
                '0' => 'Emergency',
                '2' => 'Critical',
                '3' => 'Error',
                '4' => 'Warning',
                '5' => 'Debug'
            ],
            'email' => ['callcocam@gmail.com'],
            'from' => 'contato@sigasmart.com.br',
        ]
    ],
    'service_manager' => [
        'factories' => [
            'log' => \Core\Log\Factory\Log::class,
            'errorhandling' => \Core\Log\Factory\ErrorHandling::class,
            'mail-transport' => \Core\Mail\Factory\SmtpTransport::class,
            'mail-template' => \Core\Mail\Factory\TemplateFactory::class,
            'mail-options' => \Core\Mail\Factory\OptionsFactory::class,
        ]
    ]
];
