<?php
namespace Blog\Service;

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
     * @var EntityRepository
     */
    protected $postRepository;

    /**
     * @param EntityRepository $postRepository
     */
    public function __construct(EntityRepository $postRepository)
    {
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
}
