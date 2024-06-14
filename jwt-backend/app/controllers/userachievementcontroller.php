<?php
namespace Controllers;

use Exception;
use Services\UserAchievementService;

class UserAchievementController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new UserAchievementService();
    }

    public function getAll()
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

        $products = $this->service->getAll($offset, $limit);

        $this->respond($products);
    }

    public function getAllByUserId($user_id){
        if (!$this->authenticateUser()) {
            return;
        }

        $offset = NULL;
        $limit = NULL;

        $products = $this->service->getAllByUserId($user_id, $offset, $limit);

        $this->respond($products);
    }

    public function create() {
        if (!$this->authenticateAdmin()) {
            return;
        }

        $postedUserAchievement = $this->createObjectFromPostedJson("Models\\UserAchievement");
        $userAchievement = $this->service->insert($postedUserAchievement);
        $this->respond($userAchievement);
    }

    public function delete($id) {
        if (!$this->authenticateAdmin()) {
            return;
        }

        $userAchievement = $this->service->getOne($id);
        if (!$userAchievement) {
            $this->respondWithError(404, "UserAchievement not found");
            return;
        }

        $this->service->delete($userAchievement);
        $this->respond("UserAchievement deleted");
    }

    public function unassign() {
        if (!$this->authenticateAdmin()) {
            return;
        }

        $postedUserAchievement = $this->createObjectFromPostedJson("Models\\UserAchievement");
        if (!$postedUserAchievement->user_id || !$postedUserAchievement->achievement_id) {
            $this->respondWithError(400, "Missing user_id or achievement_id");
            return;
        }
        $userAchievement = $this->service->getOneByUserIdAndAchievementId($postedUserAchievement->user_id, $postedUserAchievement->achievement_id);
        if (!$userAchievement) {
            $this->respondWithError(404, "UserAchievement not found");
            return;
        }

        $this->service->delete($userAchievement);
        $this->respond("UserAchievement unassigned");
    }
}