<?php

namespace Controllers;

use Exception;
use Services\AchievementService;

class AchievementController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new AchievementService();
    }

    public function getAll()
    {
        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $achievements = $this->service->getAll($offset, $limit);

        $this->respond($achievements);
    }

    public function getOne($id)
    {
        $achievement = $this->service->getOne($id);

        if (!$achievement) {
            $this->respondWithError(404, "achievement not found");
            return;
        }
        $this->respond($achievement);
    }

    public function create()
    {
        try {
            if (!$this->authenticateAdmin()) {
                return;
            }
            $achievement = $this->createObjectFromPostedJson("Models\\Achievement");
            $achievement = $this->service->insert($achievement);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
        $this->respond($achievement);
    }

    public function update($id)
    {
        try {
            if (!$this->authenticateAdmin()) {
                return;
            }
            $achievement = $this->createObjectFromPostedJson("Models\\Achievement");
            $achievement->achievement_id = $id;
            $achievement = $this->service->update($achievement);

        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
        $this->respond("Achievement updated");
    }

    public function delete($id)
    {
        try {
            if (!$this->authenticateAdmin()) {
                return;
            }
            $this->service->delete($id);
        } catch (Exception $e) {
            $this->respondWithError(500, $e->getMessage());
        }
        $this->respond("Achievement deleted");
    }

    public function getAllOwnedAchievements($user_id)
    {
        if (!$this->authenticateAdmin()) {
            return;
        }

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $achievements = $this->service->getAllOwnedAchievements($user_id, $offset, $limit);
        $this->respond($achievements);
    }

    public function getAllUnownedAchievements($user_id)
    {
        if (!$this->authenticateAdmin()) {
            return;
        }

        $offset = NULL;
        $limit = NULL;

        if (isset($_GET["offset"]) && is_numeric($_GET["offset"])) {
            $offset = $_GET["offset"];
        }
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $achievements = $this->service->getAllUnownedAchievements($user_id, $offset, $limit);
        $this->respond($achievements);
    }
}
