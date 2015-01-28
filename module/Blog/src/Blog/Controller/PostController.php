<?php
namespace Blog\Controller;

use Blog\Entity\Post;
use ZfrRest\Mvc\Controller\AbstractRestfulController;

/**
 * Class PostController
 * @package Blog\Controller
 */
class PostController extends AbstractRestfulController
{
    /**
     * @param  Post $post
     * @return \ZfrRest\View\Model\ResourceModel
     */
    public function get(Post $post)
    {
        return $this->resourceModel($post);
    }
}
