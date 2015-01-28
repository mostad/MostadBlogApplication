<?php
namespace Blog\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZfrRest\Resource\Metadata\Annotation as REST;

/**
 * Class Post
 * @package Blog\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="post")
 *
 * @REST\Resource(
 *      controller="Blog\Controller\PostController",
 *      inputFilter="Blog\InputFilter\PostInputFilter",
 *      hydrator="Zend\Stdlib\Hydrator\ClassMethods"
 * )
 * @REST\Collection(
 *      controller="Blog\Controller\PostsController"
 * )
 */
class Post
{
    /**
     * @var int
     *
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=128, nullable=false)
     */
    protected $header;

    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=false)
     */
    protected $body;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getHeader()
    {
        return $this->header;
    }

    /**
     * @param string $header
     */
    public function setHeader($header)
    {
        $this->header = $header;
    }

    /**
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $body
     */
    public function setBody($body)
    {
        $this->body = $body;
    }
}
