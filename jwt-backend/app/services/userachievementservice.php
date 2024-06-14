<?php

namespace Services;

use Repositories\UserAchievementRepository;

class UserAchievementService
{
    private $repository;

    function __construct()
    {
        $this->repository = new UserAchievementRepository();
    }

    function getAll($offset, $limit)
    {
        return $this->repository->getAll($offset, $limit);
    }

    function getOne($id)
    {
        return $this->repository->getOne($id);
    }

    function getAllByUserId($userId, $offset, $limit)
    {
        return $this->repository->getAllByUserId($userId, $offset, $limit);
    }

    function insert($userachievement)
    {
        return $this->repository->insert($userachievement);
    }

    function delete($userachievement)
    {
        return $this->repository->delete($userachievement);
    }

    function getOneByUserIdAndAchievementId($userId, $achievementId)
    {
        return $this->repository->getOneByUserIdAndAchievementId($userId, $achievementId);
    }
}