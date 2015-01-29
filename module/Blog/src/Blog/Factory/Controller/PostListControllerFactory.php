<?php
namespace Blog\Factory\Controller;

use Blog\Controller\PostListController;
use Blog\Service\PostService;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class PostListControllerFactory
 * @package Blog\Factory\Controller
 */
class PostListControllerFactory implements FactoryInterface
{
    /**
     * @param  ServiceLocatorInterface $controllerManager
     * @return PostListController
     */
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        /**
         * @var \Zend\Mvc\Controller\ControllerManager $controllerManager
         * @var PostService                            $postService
         */
        $postService = $controllerManager->getServiceLocator()->get(PostService::class);

        return new PostListController(
            $postService
        );
    }
}
