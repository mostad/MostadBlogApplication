<?php
namespace Blog;

use Blog\Controller\PostController;
use Blog\Controller\PostListController;
use Blog\Factory\Controller\PostControllerFactory;
use Blog\Factory\Controller\PostListControllerFactory;
use Blog\Factory\Service\PostServiceFactory;
use Blog\InputFilter\PostInputFilter;
use Blog\Service\PostService;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;
use ZfcRbac\Role\InMemoryRoleProvider;

return [
    'controllers' => [
        'factories' => [
            PostController::class     => PostControllerFactory::class,
            PostListController::class => PostListControllerFactory::class,
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

    'input_filters' => [
        'invokables' => [
            PostInputFilter::class => PostInputFilter::class,
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

    'service_manager' => [
        'factories' => [
            PostService::class => PostServiceFactory::class,
        ],
    ],

    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],

        'template_map' => [
            // Unfortunately .php suffix is needed here due to how path stack works
            'default/blog/post.php'      => __DIR__ .'/../view/default/blog/post.php',
            'default/blog/post-list.php' => __DIR__ .'/../view/default/blog/post-list.php',
        ],
    ],


    'zfc_rbac' => [
        'role_provider' => [
            InMemoryRoleProvider::class => [
                'administrator' => [
                    'permissions' => [
                        PostService::CREATE,
                        PostService::DELETE,
                        PostService::UPDATE,
                    ],
                ],
            ],
        ],
    ],
];
