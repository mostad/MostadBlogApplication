<?php
namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\Service\PostService;
use Doctrine\ORM\EntityManager;
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
        return new ResourceViewModel([
            'post' => $this->postService->getPost($params['id']),
        ]);
    }
}
