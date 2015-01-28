<?php
namespace Blog;

use Blog\Controller\PostController;
use Blog\Controller\PostsController;
use Blog\Entity\Post;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'controllers' => [
        'invokables' => [
            PostController::class  => PostController::class,
            PostsController::class => PostsController::class,
        ],
    ],

    'doctrine' => [
        'driver' => [
            __NAMESPACE__ .'\Entity' => [
                'class' => AnnotationDriver::class,
                'paths' => __DIR__ .'/../src/'. __NAMESPACE__ .'/Entity',
            ],
            'orm_default' => [
                'drivers' => [
                    __NAMESPACE__ .'\Entity'  => __NAMESPACE__ .'\Entity',
                ],
            ],
        ],
    ],

    'router' => [
        'routes' => [
            'sections' => [
                'type'    => 'ResourceGraphRoute',
                'options' => [
                    'route'    => '/posts',
                    'resource' => Post::class,
                ],
            ],
        ],
    ],
];
