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
         * @var \Doctrine\Common\Persistence\ObjectManager $objectManager
         * @var \Zend\ServiceManager\ServiceManager        $serviceManager
         */
        $objectManager = $serviceManager->get(EntityManager::class);

        return new PostService(
            $objectManager->getRepository(Post::class)
        );
    }
}
