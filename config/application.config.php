<?php
return [
    'modules' => [
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfrRest',

        'Application',
        'Blog',
    ],

    'module_listener_options' => [
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
    ],
];
