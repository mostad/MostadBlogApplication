<?php
namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Service\PostService;
use Doctrine\ORM\EntityManager;
use ZfrRest\Mvc\Controller\AbstractRestfulController;
use ZfrRest\View\Model\ResourceViewModel;

/**
 * Class PostListController
 * @package Blog\Controller
 */
class PostListController extends AbstractRestfulController
{
    /**
     * @var PostService
     */
    protected $postService;

    /**
     * @param PostService $postService
     */
    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function get()
    {
        // TODO: Add pagination
        return new ResourceViewModel([
            'posts' => $this->postService->getPosts(),
        ]);
    }
}
