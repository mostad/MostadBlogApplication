<?php
return [
    'modules' => [
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfcRbac',
        'ZfrOAuth2Module\Server',
        'ZfrRest',

        'Application',
        'Blog',
        'User',
    ],

    'module_listener_options' => [
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
    ],
];
