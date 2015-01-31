<?php
namespace Blog\Service;

use Blog\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use DoctrineModule\Paginator\Adapter\Selectable;
use Zend\Paginator\Paginator;

/**
 * Class PostService
 * @package Blog\Service
 */
class PostService
{
    /**
     * @var EntityManager
     */
    protected $entityManager;

    /**
     * @var EntityRepository
     */
    protected $postRepository;

    /**
     * @param EntityManager    $entityManager
     * @param EntityRepository $postRepository
     * TODO: Replace with mapper layer
     */
    public function __construct(EntityManager $entityManager, EntityRepository $postRepository)
    {
        $this->entityManager  = $entityManager;
        $this->postRepository = $postRepository;
    }

    /**
     * @param  Post $post
     * @return Post
     */
    public function create(Post $post)
    {
        // TODO: Add RBAC through ZfcRbac for permission handling
        $this->entityManager->persist($post);
        $this->entityManager->flush();

        return $post;
    }

    /**
     * @param  int $id
     * @return Post
     */
    public function get($id)
    {
        return $this->postRepository->find($id);
    }

    /**
     * @return Paginator
     */
    public function getAll()
    {
        return new Paginator(new Selectable($this->postRepository));
    }
}
