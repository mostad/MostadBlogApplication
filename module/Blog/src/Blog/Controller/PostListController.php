<?php
namespace Blog\Controller;

use Blog\Entity\Post;
use Blog\InputFilter\PostInputFilter;
use Blog\Service\PostService;
use Zend\Stdlib\Hydrator\ClassMethods;
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
        $posts = $this->postService->getAll();
        $posts->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));

        return new ResourceViewModel(['posts' => $posts]);
    }

    /**
     * @return ResourceViewModel
     */
    public function post()
    {
        /** @var Post $post */
        $params = $this->validateIncomingData(PostInputFilter::class, ['header', 'body']);
        $post   = $this->hydrateObject(ClassMethods::class, new Post(), $params);

        $post = $this->postService->create($post);

        return new ResourceViewModel(['post' => $post,], ['template' => 'blog/post']);
    }
}
