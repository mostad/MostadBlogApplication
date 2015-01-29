<?php
namespace Blog;

use Blog\Controller\PostController;
use Blog\Controller\PostListController;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

return [
    'controllers' => [
        'invokables' => [
            PostController::class     => PostController::class,
            PostListController::class => PostListController::class,
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
            'posts' => [
                'type' => Literal::class,
                'options' => [
                    'route' => '/posts',
                    'defaults' => [
                        'controller' => PostListController::class,
                    ],
                ],
                'may_terminate' => 'true',
                'child_routes' => [
                    'post' => [
                        'type' => Segment::class,
                        'options' => [
                            'route' => '/:id',
                            'constraints' => [
                                'id' => '[0-9]*',
                            ],
                            'defaults' => [
                                'controller' => PostController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],

    'view_manager' => [
        'template_map' => [
            // Unfortunately .php suffix is needed here due to how path stack works
            'default/blog/post.php' => __DIR__ .'/../view/default/blog/post.php',
        ],
    ],
];
