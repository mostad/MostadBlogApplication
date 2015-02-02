<?php
namespace Blog\Factory\Service;

use Blog\Entity\Post;
use Blog\Service\PostService;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZfcRbac\Service\AuthorizationService;

/**
 * Class PostServiceFactory
 * @package Blog\Factory\Service
 */
class PostServiceFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $serviceManager
     * @return PostService
     */
    public function createService(ServiceLocatorInterface $serviceManager)
    {
        /**
         * @var AuthorizationService                $authorizationService
         * @var EntityManager                       $entityManager
         * @var \Zend\ServiceManager\ServiceManager $serviceManager
         */
        $authorizationService = $serviceManager->get(AuthorizationService::class);
        $entityManager        = $serviceManager->get(EntityManager::class);

        return new PostService(
            $authorizationService,
            $entityManager,
            $entityManager->getRepository(Post::class)
        );
    }
}
