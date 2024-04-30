<?php
namespace Models;

class achievement {

    public int $achievement_id;
    public string $title;
    public ?string $description;
    public ?string $image_path;
    public ?int $progress_current;
    public ?int $progress_limit;

}
