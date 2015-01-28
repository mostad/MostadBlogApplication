<?php
return [
    'modules' => [
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfrRest',

        'Application',
    ],

    'module_listener_options' => [
        'module_paths' => [
            './module',
        ],

        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
    ],
];
