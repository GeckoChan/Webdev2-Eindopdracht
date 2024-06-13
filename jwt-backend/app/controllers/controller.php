<?php

namespace Controllers;

use Exception;
use \Firebase\JWT\JWT;
use \Firebase\JWT\Key;

class Controller
{
    function checkForJwt()
    {
        // Check for token header
        if (!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            $this->respondWithError(401, "No token provided");
            return;
        }

        // Read JWT from header
        $authHeader = $_SERVER['HTTP_AUTHORIZATION'];
        // Strip the part "Bearer " from the header
        $arr = explode(" ", $authHeader);
        $jwt = $arr[1];

        // Decode JWT
        $secret_key = "YOUR_SECRET_KEY";

        if ($jwt) {
            try {
                $decoded = JWT::decode($jwt, new Key($secret_key, 'HS256'));
                // username is now found in
                // echo $decoded->data->username;
                return $decoded;
            } catch (Exception $e) {
                $this->respondWithError(401, $e->getMessage());
                return;
            }
        }
    }

    function generateJwt($user)
    {
        $secret_key = "YOUR_SECRET_KEY";
        $issuer = "http://localhost";
        $audience = "http://localhost";
        $issuedAt = time();
        $notBefore = $issuedAt;
        $expirationTime = $issuedAt + 1800; // token is valid for 30 minutes


        $payload = array(
            "iss" => $issuer,
            "aud" => $audience,
            "iat" => $issuedAt,
            "nbf" => $notBefore,
            "exp" => $expirationTime,
            "data" => array(
                "user_id" => $user->user_id,
                "username" => $user->username,
                "email" => $user->email,
                "user_role" => $user->user_role
            )
        );

        $jwt = JWT::encode($payload, $secret_key, 'HS256');
        return $jwt;
    }

    function authenticateAdmin()
    {
        $decoded = $this->checkForJwt();

        if (!$decoded) {
            return;
        } else if ($decoded->data->user_role != "admin") {
            $this->respondWithError(401, "Unauthorized");
            return;
        }
        return true;;
    }

    function authenticateUser()
    {
        $decoded = $this->checkForJwt();

        if (!$decoded) {
            return;
        }
        return $decoded;
    }

    function respond($data)
    {
        $this->respondWithCode(200, $data);
    }

    function respondWithError($httpcode, $message)
    {
        $data = array('errorMessage' => $message);
        $this->respondWithCode($httpcode, $data);
    }

    private function respondWithCode($httpcode, $data)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($httpcode);
        echo json_encode($data);
    }

    function createObjectFromPostedJson($className)
    {
        $json = file_get_contents('php://input');
        $data = json_decode($json);

        $object = new $className();
        foreach ($data as $key => $value) {
            if (is_object($value)) {
                continue;
            }
            $object->{$key} = $value;
        }
        return $object;
    }
}
