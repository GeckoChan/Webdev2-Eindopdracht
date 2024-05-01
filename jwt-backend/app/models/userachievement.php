<?php
namespace Models;

class UserAchievement {
    public int $users_achievements_id;
    public int $user_id;
    public int $achievement_id;
    public ?int $progress;
   
    public User $user;
    public Achievement $achievement;
    
}