<?php

namespace Services;

use Repositories\AchievementRepository;

class AchievementService
{
    private $repository;

    function __construct()
    {
        $this->repository = new AchievementRepository();
    }

    function getAll($offset, $limit)
    {
        return $this->repository->getAll($offset, $limit);
    }

    function getOne($id)
    {
        return $this->repository->getOne($id);
    }

    function insert($achievement)
    {
        return $this->repository->insert($achievement);
    }

    function delete($achievement)
    {
        return $this->repository->delete($achievement);
    }
}