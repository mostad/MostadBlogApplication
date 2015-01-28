<?php
return [
    'modules' => [
        'DoctrineModule',
        'DoctrineORMModule',
        'ZfrRest',

        'Application',
    ],

    'module_listener_options' => [
        'config_glob_paths' => [
            'config/autoload/{,*.}{global,local}.php',
        ],
    ],
];
