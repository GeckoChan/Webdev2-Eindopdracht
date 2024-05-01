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
        // $decoded = $this->checkForJwt();

        // if (!$decoded) {
        //     return;
        // }

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
}