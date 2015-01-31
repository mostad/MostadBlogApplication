<?php
namespace Blog\Service;

use Blog\Entity\Post;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use DoctrineModule\Paginator\Adapter\Selectable;
use Zend\Paginator\Paginator;
use ZfrRest\Http\Exception\Client\NotFoundException;

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
     * @param  int $id
     * @return \Blog\Entity\Post
     * @throws NotFoundException
     */
    public function getPost($id)
    {
        $post = $this->postRepository->find($id);

        if (!$post) {
            throw new NotFoundException(sprintf('Post with id %d could not be found', $id));
        }

        return $post;
    }

    /**
     * @param  int $page
     * @return Paginator
     */
    public function getPosts($page = 1)
    {
        $adapter   = new Selectable($this->postRepository);
        $paginator = new Paginator($adapter);
        $paginator->setCurrentPageNumber($page);

        return $paginator;
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
}
