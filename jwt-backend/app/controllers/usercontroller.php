<?php

namespace Controllers;

use Exception;
use Services\UserService;

class UserController extends Controller
{
    private $service;

    function __construct()
    {
        $this->service = new UserService();
    }

    public function login()
    {
        $postedUser = $this->createObjectFromPostedJson("Models\\User");
        $user = $this->service->checkUsernamePassword($postedUser->username, $postedUser->password);
        if (!$user) {
            $this->respondWithError(401, "Incorrect username or password");
            return;
        }

        $tokenResponse = $this->generateJwt($user);

        $response = [
            "user_id" => $user->user_id,
            "username" => $user->username,
            "email" => $user->email,
            "role" => $user->user_role,
            "jwt" => $tokenResponse
        ];


        $this->respond($response);
    }

    public function getTopUsers()
    {
        $limit = NULL;
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $users = $this->service->getTopUsers($limit);
        $this->respond($users);
    }

    public function register()
    {
        $postedUser = $this->createObjectFromPostedJson("Models\\User");
        $postedUser->user_role = "user";
        $user_id = $this->service->insert($postedUser);
        if (!$user_id) {
            $this->respondWithError(500, "User could not be created");
            return;
        }
        $this->respond($user_id);
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

    public function getOne($id)
    {
        if (!$this->authenticateAdmin()){
            return;
        }
        $achievement = $this->service->getOne($id);

        if (!$achievement) {
            $this->respondWithError(404, "achievement not found");
            return;
        }
        $this->respond($achievement);
    }

    public function getAll()
    {
        if (!$this->authenticateAdmin()){
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

        $achievements = $this->service->getAll($offset, $limit);

        $this->respond($achievements);
    }

}

