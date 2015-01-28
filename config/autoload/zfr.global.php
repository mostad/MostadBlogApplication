<?php
use ZfrRest\Resource\Metadata\Driver\AnnotationDriver;

return [
    'zfr_rest' => [
        'object_manager' => 'doctrine.entitymanager.orm_default',
        'drivers' => [
            [
                'class' => AnnotationDriver::class,
            ]
        ],
        'cache'   => [
            'adapter' => 'memory',
        ],
    ],
];
