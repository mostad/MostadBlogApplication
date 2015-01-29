<?php
namespace Blog\Service;

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
     * @return null|object
     */
    public function getPost($id)
    {
        return $this->postRepository->find($id);
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
