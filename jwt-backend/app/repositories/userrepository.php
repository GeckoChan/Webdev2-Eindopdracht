<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class UserRepository extends Repository
{
    function checkUsernamePassword($username, $password)
    {
        try {
            $stmt = $this->connection->prepare("SELECT user_id, user_role, username, password, email FROM users WHERE username = :username");
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
            $user = $stmt->fetch();

            if (!$user)
                return false;

            
            $result = $this->verifyPassword($password, $user->password);

            if (!$result)
                return false;


            $user->password = "";

            return $user;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($user){
        try {
            $password = $this->hashPassword($user->password);
            $stmt = $this->connection->prepare("INSERT INTO users (user_role, username, password, email) VALUES (:user_role, :username, :password, :email)");
            $stmt->bindParam(':user_role', $user->user_role);
            $stmt->bindParam(':username', $user->username);
            $stmt->bindParam(':password', $password);
            $stmt->bindParam(':email', $user->email);
            $stmt->execute();

            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo $e;
        }
    
    }

    function delete($user){
        try {
            $stmt = $this->connection->prepare("DELETE FROM users WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $user->user_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function hashPassword($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    function verifyPassword($input, $hash)
    {
        return password_verify($input, $hash);
    }
}
