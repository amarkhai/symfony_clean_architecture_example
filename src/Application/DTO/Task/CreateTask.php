<?php

declare(strict_types=1);

namespace App\Application\DTO\Task;

class CreateTask
{
    public string $title;

    public string $description;

    public string $creatorUuid;
}