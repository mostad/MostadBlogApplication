<?php
namespace Blog\Controller;

use Blog\Service\PostService;
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

    /**
     * @return ResourceViewModel
     */
    public function get()
    {
        $page = (int) $this->params()->fromQuery('page', 1);

        return new ResourceViewModel([
            'posts' => $this->postService->getPosts($page),
        ]);
    }
}
