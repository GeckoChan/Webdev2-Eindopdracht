<?php
namespace Models;

class Achievement {

    public int $achievement_id;
    public string $title;
    public ?string $description;
    public ?string $image_path;
    public ?int $progress_limit;

}
