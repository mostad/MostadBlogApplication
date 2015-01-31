<?php
namespace Blog\Factory\Service;

use Blog\Entity\Post;
use Blog\Service\PostService;
use Doctrine\ORM\EntityManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

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
         * @var EntityManager                       $entityManager
         * @var \Zend\ServiceManager\ServiceManager $serviceManager
         */
        $entityManager = $serviceManager->get(EntityManager::class);

        return new PostService(
            $entityManager,
            $entityManager->getRepository(Post::class)
        );
    }
}
