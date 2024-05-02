<?php
namespace Services;

use Repositories\UserRepository;

class UserService
{
    private $repository;

    function __construct()
    {
        $this->repository = new UserRepository();
    }

    public function checkUsernamePassword($username, $password)
    {
        return $this->repository->checkUsernamePassword($username, $password);
    }

    public function insert($user)
    {
        return $this->repository->insert($user);
    }

    public function delete($user)
    {
        return $this->repository->delete($user);
    }

    public function getTopUsers($limit = null)
    {
        return $this->repository->getTopUsers($limit);
    }
}
