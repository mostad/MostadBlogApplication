<?php
namespace Blog\Controller;

use Doctrine\Common\Collections\Selectable;
use ZfrRest\Mvc\Controller\AbstractRestfulController;

/**
 * Class PostsController
 * @package Blog\Controller
 */
class PostsController extends AbstractRestfulController
{
    /**
     * @param  Selectable $posts
     * @return \ZfrRest\View\Model\ResourceModel
     */
    public function get(Selectable $posts)
    {
        return $this->resourceModel($posts);
    }
}
