<?php
namespace Blog\Controller;

use Blog\Entity\Post;
use Doctrine\ORM\EntityManager;
use ZfrRest\Mvc\Controller\AbstractRestfulController;
use ZfrRest\View\Model\ResourceViewModel;

/**
 * Class PostController
 * @package Blog\Controller
 */
class PostController extends AbstractRestfulController
{
    public function get(array $params)
    {
        // TODO: Move to DI
        /** @var \Doctrine\Common\Persistence\ObjectManager $objectManager */
        $objectManager  = $this->getServiceLocator()->get(EntityManager::class);
        $postRepository = $objectManager->getRepository(Post::class);

        $id   = $params['id'];
        $post = $postRepository->find($id);

        return new ResourceViewModel([
            'post' => $post,
        ]);
    }
}
