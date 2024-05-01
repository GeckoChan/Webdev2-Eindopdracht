<?php
namespace Repositories;

use PDO;
use PDOException;

class UserAchievementRepository extends Repository
{

    function getAll($offset, $limit)
    {
        try {
            $query = "SELECT user_id, achievement_id, progress FROM users_achievements";
            if (isset($limit) && isset($offset)) {
                $query .= " LIMIT :limit OFFSET :offset ";
            }
            $stmt = $this->connection->prepare($query);
            if (isset($limit) && isset($offset)) {
                $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
                $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
            }
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\UserAchievement');
            $userAchievements = $stmt->fetchAll();

            foreach ($userAchievements as $userAchievement) {
                $userStmt = $this->connection->prepare("SELECT * FROM users WHERE user_id = :id");
                $userStmt->bindParam(':id', $userAchievement->user_id);
                $userStmt->execute();

                $userStmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
                $userAchievement->user = $userStmt->fetch();
                $userAchievement->user->password = "";

                $achievementStmt = $this->connection->prepare("SELECT * FROM achievements WHERE achievement_id = :id");
                $achievementStmt->bindParam(':id', $userAchievement->achievement_id);
                $achievementStmt->execute();

                $achievementStmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Achievement');
                $userAchievement->achievement = $achievementStmt->fetch();
            }

            return $userAchievements;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function getOne($achievementId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users_achievements WHERE achievement_id = :achievement_id");
            $stmt->bindParam(':achievement_id', $achievementId);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\UserAchievement');
            $userAchievements = $stmt->fetchAll();

            foreach ($userAchievements as $userAchievement) {
                $userStmt = $this->connection->prepare("SELECT * FROM users WHERE user_id = :id");
                $userStmt->bindParam(':id', $userAchievement->user_id);
                $userStmt->execute();

                $userStmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
                $userAchievement->user = $userStmt->fetch();
                $userAchievement->user->password = "";

                $achievementStmt = $this->connection->prepare("SELECT * FROM achievements WHERE achievement_id = :id");
                $achievementStmt->bindParam(':id', $userAchievement->achievement_id);
                $achievementStmt->execute();

                $achievementStmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Achievement');
                $userAchievement->achievement = $achievementStmt->fetch();
            }

            return $userAchievements;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllByUserId($userId)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM users_achievements WHERE user_id = :user_id");
            $stmt->bindParam(':user_id', $userId);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Models\UserAchievement');
            $userAchievements = $stmt->fetchAll();

            foreach ($userAchievements as $userAchievement) {
                $userStmt = $this->connection->prepare("SELECT * FROM users WHERE user_id = :id");
                $userStmt->bindParam(':id', $userAchievement->user_id);
                $userStmt->execute();

                $userStmt->setFetchMode(PDO::FETCH_CLASS, 'Models\User');
                $userAchievement->user = $userStmt->fetch();
                $userAchievement->user->password = "";

                $achievementStmt = $this->connection->prepare("SELECT * FROM achievements WHERE achievement_id = :id");
                $achievementStmt->bindParam(':id', $userAchievement->achievement_id);
                $achievementStmt->execute();

                $achievementStmt->setFetchMode(PDO::FETCH_CLASS, 'Models\Achievement');
                $userAchievement->achievement = $achievementStmt->fetch();
            }

            return $userAchievements;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function insert($userAchievement)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO users_achievements (user_id, achievement_id, progress) VALUES (:user_id, :achievement_id, :progress)");
            $stmt->bindParam(':user_id', $userAchievement->user_id);
            $stmt->bindParam(':achievement_id', $userAchievement->achievement_id);
            $stmt->bindParam(':progress', $userAchievement->progress);
            $stmt->execute();

            return $this->connection->lastInsertId();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function update($userAchievement)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE users_achievements SET progress = :progress WHERE user_id = :user_id AND achievement_id = :achievement_id");
            $stmt->bindParam(':user_id', $userAchievement->user_id);
            $stmt->bindParam(':achievement_id', $userAchievement->achievement_id);
            $stmt->bindParam(':progress', $userAchievement->progress);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function delete($userAchievement)
    {
        try {
            $stmt = $this->connection->prepare("DELETE FROM users_achievements WHERE user_id = :user_id AND achievement_id = :achievement_id");
            $stmt->bindParam(':user_id', $userAchievement->user_id);
            $stmt->bindParam(':achievement_id', $userAchievement->achievement_id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
    }


}