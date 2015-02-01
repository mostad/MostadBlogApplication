<?php
namespace Blog\Controller;

use Blog\InputFilter\PostInputFilter;
use Blog\Service\PostService;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\View\Model\JsonModel;
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
     * @return JsonModel
     * @throws NotFoundException
     */
    public function delete(array $params)
    {
        if (!$post = $this->postService->get((int) $params['id'])) {
            throw new NotFoundException();
        }

        $this->postService->delete($post);

        return new JsonModel();
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

    public function put(array $params)
    {
        if (!$post = $this->postService->get((int) $params['id'])) {
            throw new NotFoundException();
        }

        /** @var \Blog\Entity\Post $post */
        $data = $this->validateIncomingData(PostInputFilter::class);
        $post = $this->hydrateObject(ClassMethods::class, $post, $data);

        $post = $this->postService->update($post);

        return new ResourceViewModel(['post' => $post,], ['template' => 'blog/post']);
    }
}
