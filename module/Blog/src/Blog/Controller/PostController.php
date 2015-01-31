<?php
namespace Blog\Controller;

use Blog\Service\PostService;
use ZfrRest\Http\Exception\Client\NotFoundException;
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
     * @throws NotFoundException
     */
    public function get(array $params)
    {
        if (!$post = $this->postService->get((int) $params['id'])) {
            throw new NotFoundException();
        }

        return new ResourceViewModel(['post' => $post]);
    }
}
