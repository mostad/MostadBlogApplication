<?php
namespace Blog\Factory\Controller;

use Blog\Controller\PostController;
use Blog\Service\PostService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PostControllerFactory
 * @package Blog\Factory\Controller
 */
class PostControllerFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $controllerManager
     * @return PostController
     */
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        /**
         * @var \Zend\Mvc\Controller\ControllerManager $controllerManager
         * @var PostService                            $postService
         */
        $postService = $controllerManager->getServiceLocator()->get(PostService::class);

        return new PostController(
            $postService
        );
    }
}
