<?php
namespace Blog\Controller;

use Blog\Service\PostService;
use ZfrRest\Mvc\Controller\AbstractRestfulController;
use ZfrRest\View\Model\ResourceViewModel;

/**
 * Class PostController
 * @package Blog\Controller
 */
class PostController extends AbstractRestfulController
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
     * @param  array $params
     * @return ResourceViewModel
     */
    public function get(array $params)
    {
        $id   = (int) $params['id'];
        $post = $this->postService->getPost($id);

        return new ResourceViewModel([
            'post' => $post,
        ]);
    }
}
