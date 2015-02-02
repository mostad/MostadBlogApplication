<?php
namespace User;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\Driver\AnnotationDriver;
use User\Entity\User;
use User\Factory\Grant\GoogleGrantFactory;
use User\Factory\Service\UserServiceFactory;
use User\Grant\GoogleGrant;
use User\Service\UserService;
use Zend\Authentication\AuthenticationService;
use ZfrOAuth2\Server\Entity\TokenOwnerInterface;
use ZfrOAuth2\Server\Exception\InvalidAccessTokenException;
use ZfrOAuth2\Server\Grant\RefreshTokenGrant;
use ZfrOAuth2Module\Server\Factory\AuthenticationServiceFactory;
use ZfrRest\Http\Exception\Client\UnauthorizedException;

return [
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
        'entity_resolver' => [
            'orm_default' => [
                'resolvers' => [
                    TokenOwnerInterface::class => User::class,
                ],
            ],
        ],
    ],

    'service_manager' => [
        'factories' => [
            AuthenticationService::class => AuthenticationServiceFactory::class,
            UserService::class           => UserServiceFactory::class,
        ]
    ],

    'zfr_oauth2_server' => [
        'grant_manager' => [
            'factories' => [
                GoogleGrant::class => GoogleGrantFactory::class,
            ],
        ],
        'grants' => [
            GoogleGrant::class,
            RefreshTokenGrant::class,
        ],
        'object_manager' => EntityManager::class,
    ],

    'zfr_rest' => [
        'exception_map' => [
            InvalidAccessTokenException::class => UnauthorizedException::class
        ],
    ],
];
