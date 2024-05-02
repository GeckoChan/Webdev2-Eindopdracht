<?php

namespace Controllers;

use Services\UserService;

class UserController extends Controller
{
    private $service;

    // initialize services
    function __construct()
    {
        $this->service = new UserService();
    }

    public function login() {
        $postedUser = $this->createObjectFromPostedJson("Models\\User");
        $user = $this->service->checkUsernamePassword($postedUser->username, $postedUser->password);
        if (!$user) {
            $this->respondWithError(401, "Incorrect username or password");
            return;
        }

        $tokenResponse = $this->generateJwt($user);
        
        $response = [
            "username" => $user->username,
            "email" => $user->email,
            "role" => $user->user_role,
            "jwt" => $tokenResponse
        ];
        

        $this->respond($response);
    }  

    public function register() {
        $postedUser = $this->createObjectFromPostedJson("Models\\User");
        $postedUser->user_role = "user";
        $user_id = $this->service->insert($postedUser);
        if (!$user_id) {
            $this->respondWithError(500, "User could not be created");
            return;
        }
        $this->respond($user_id);
    }

    public function delete() {
        $decoded = $this->checkForJwt();

        if (!$decoded) {
            return;
        } else if ($decoded->user_role != "admin") {
            $this->respondWithError(401, "Unauthorized");
            return;
        }
        // read user data from request body

        // delete user from db

        // return success message
    }

    public function getTopUsers() {
        $limit = NULL;
        if (isset($_GET["limit"]) && is_numeric($_GET["limit"])) {
            $limit = $_GET["limit"];
        }

        $users = $this->service->getTopUsers($limit);
        $this->respond($users);
    }
}
