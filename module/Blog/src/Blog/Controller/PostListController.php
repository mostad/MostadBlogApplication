<?php
namespace Blog\Controller;

use Blog\Entity\Post;
use Doctrine\ORM\EntityManager;
use ZfrRest\Mvc\Controller\AbstractRestfulController;
use ZfrRest\View\Model\ResourceViewModel;

/**
 * Class PostListController
 * @package Blog\Controller
 */
class PostListController extends AbstractRestfulController
{
    public function get()
    {
        // TODO: Move to DI
        /** @var \Doctrine\Common\Persistence\ObjectManager $objectManager */
        $objectManager  = $this->getServiceLocator()->get(EntityManager::class);
        $postRepository = $objectManager->getRepository(Post::class);

        // TODO: Add pagination
        $posts = $postRepository->findAll();

        return new ResourceViewModel([
            'posts' => $posts,
        ]);
    }
}
