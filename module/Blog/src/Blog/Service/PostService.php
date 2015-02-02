<?php
namespace Blog\Service;

use Blog\Entity\Post;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Doctrine\Common\Persistence\ObjectManager;
use DoctrineModule\Paginator\Adapter\Selectable as SelectableAdapter;
use Zend\Paginator\Paginator;
use ZfcRbac\Service\AuthorizationService;
use ZfrRest\Http\Exception\Client\UnauthorizedException;

/**
 * Class PostService
 * @package Blog\Service
 */
class PostService
{
    const PERMISSION_CREATE = 'Blog\Service\PostService.create';
    const PERMISSION_DELETE = 'Blog\Service\PostService.delete';
    const PERMISSION_UPDATE = 'Blog\Service\PostService.update';

    /**
     * @var AuthorizationService
     */
    protected $authorizationService;

    /**
     * @var ObjectManager
     */
    protected $objectManager;

    /**
     * @var Selectable
     */
    protected $posts;

    /**
     * @param AuthorizationService $authorizationService
     * @param ObjectManager        $objectManager
     * @param Selectable           $posts
     */
    public function __construct(AuthorizationService $authorizationService, ObjectManager $objectManager, Selectable $posts)
    {
        $this->authorizationService = $authorizationService;
        $this->objectManager        = $objectManager;
        $this->posts                = $posts;
    }

    /**
     * @param  Post $post
     * @return Post
     * @throws UnauthorizedException
     */
    public function create(Post $post)
    {
        if (!$this->authorizationService->isGranted(self::CREATE)) {
            throw new UnauthorizedException();
        }

        $this->objectManager->persist($post);
        $this->objectManager->flush();

        return $post;
    }

    /**
     * @param  Post $post
     * @throws UnauthorizedException
     */
    public function delete(Post $post)
    {
        if (!$this->authorizationService->isGranted(self::DELETE)) {
            throw new UnauthorizedException();
        }

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
     * @throws UnauthorizedException
     */
    public function update(Post $post)
    {
        if (!$this->authorizationService->isGranted(self::UPDATE)) {
            throw new UnauthorizedException();
        }

        $this->objectManager->persist($post);
        $this->objectManager->flush();

        return $post;
    }
}
