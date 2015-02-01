<?php
namespace User\Service;

use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;

class UserService
{
    protected $users;

    public function __construct(Selectable $users)
    {
        $this->users = $users;
    }

    public function get($id)
    {
        return $this->users->matching(Criteria::create()->where(Criteria::expr()->eq('id', $id)))->first();
    }
}
