<?php
namespace User\Entity;

use Doctrine\ORM\Mapping as ORM;
use ZfrOAuth2\Server\Entity\TokenOwnerInterface;

/**
 * Class User
 * @package User\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements TokenOwnerInterface
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
     * @ORM\Column(type="string", nullable=true, unique=true)
     */
    protected $email;

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
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return int
     */
    public function getTokenOwnerId()
    {
        return $this->getId();
    }
}
