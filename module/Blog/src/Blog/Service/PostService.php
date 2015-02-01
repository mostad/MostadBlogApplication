<?php
namespace Blog\Service;

use Blog\Entity\Post;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Paginator\Adapter\Selectable as SelectableAdapter;
use Zend\Paginator\Paginator;

/**
 * Class PostService
 * @package Blog\Service
 */
class PostService
{
    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var Selectable
     */
    protected $posts;

    /**
     * @param ObjectManager $objectManager
     * @param Selectable    $posts
     */
    public function __construct(ObjectManager $objectManager, Selectable $posts)
    {
        $this->objectManager = $objectManager;
        $this->posts         = $posts;
    }

    /**
     * @param  Post $post
     * @return Post
     */
    public function create(Post $post)
    {
        // TODO: Add RBAC through ZfcRbac for permission handling
        $this->objectManager->persist($post);
        $this->objectManager->flush();

        return $post;
    }

    /**
     * @param Post $post
     */
    public function delete(Post $post)
    {
        // TODO: Add RBAC through ZfcRbac for permission handling
        $this->objectManager->remove($post);
        $this->objectManager->flush();
    }

    /**
     * @param  int $id
     * @return Post
     */
    public function get($id)
    {
        return $this->posts->matching(Criteria::create()->where(Criteria::expr()->eq('id', $id)))->first();
    }

    /**
     * @return Paginator
     */
    public function getAll()
    {
        return new Paginator(new SelectableAdapter($this->posts));
    }

    /**
     * @param  Post $post
     * @return Post
     */
    public function update(Post $post)
    {
        // TODO: Add RBAC through ZfcRbac for permission handling
        $this->objectManager->persist($post);
        $this->objectManager->flush();

        return $post;
    }
}
