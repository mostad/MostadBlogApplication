<?php
namespace Blog\Service;

use Doctrine\Common\Persistence\ObjectRepository;

/**
 * Class PostService
 * @package Blog\Service
 */
class PostService
{
    /**
     * @var ObjectRepository
     */
    protected $postRepository;

    /**
     * @param ObjectRepository $postRepository
     */
    public function __construct(ObjectRepository $postRepository)
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

    public function getPosts()
    {
        return $this->postRepository->findAll();
    }
}
