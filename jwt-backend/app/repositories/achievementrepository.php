<?php

namespace Repositories;

use PDO;
use PDOException;
use Repositories\Repository;

class Achievementrepository extends Repository
{
    function getAll($offset = NULL, $limit = NULL)
    {
        try {
            $query = "SELECT achievement_id, title, description, image_path, progress_limit FROM achievements";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Achievement');
            $achievements = $stmt->fetchAll();

            return $achievements;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT achievement_id, title, description, image_path, progress_limit FROM achievements WHERE achievement_id = :achievement_id");
            $stmt->bindParam(':achievement_id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Achievement');
            $achievement = $stmt->fetch();

            return $achievement;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($achievement)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO achievements (title, description, image_path, progress_limit) VALUES (:title, :description, :image_path, :progress_limit)");
            $stmt->bindParam(':title', $achievement->title);
            $stmt->bindParam(':description', $achievement->description);
            $stmt->bindParam(':image_path', $achievement->image_path);
            $stmt->bindParam(':progress_limit', $achievement->progress_limit);
            $stmt->execute();

            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($achievement)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM achievements WHERE achievement_id = :achievement_id");
            $stmt->bindParam(':achievement_id', $achievement->achievement_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

}