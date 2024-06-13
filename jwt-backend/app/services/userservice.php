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

    public function getTopUsers($limit = null)
    {
        return $this->repository->getTopUsers($limit);
    }

    public function insert($user)
    {
        return $this->repository->insert($user);
    }

    public function delete($user)
    {
        return $this->repository->delete($user);
    }

    public function update($user)
    {
        return $this->repository->update($user);
    }

    public function getAll($offset = null, $limit = null)
    {
        return $this->repository->getAll($offset, $limit);
    }

    public function getOne($id)
    {
        return $this->repository->getOne($id);
    }
    
}
