<?php

declare(strict_types=1);

namespace App\Application\UseCase\Task;

use App\Application\DTO\Task\CreateTask;
use App\Application\Gateway\Repository\Task\TaskRepositoryInterface;
use App\Application\Gateway\Repository\Task\UserRepositoryInterface;
use App\Domain\Entity\Task;
use App\Domain\Entity\User;

class TaskCreator
{
    public function __construct(
        private readonly UserRepositoryInterface $userRepository,
        private readonly TaskRepositoryInterface $taskRepository
    ) {
    }

    public function __invoke(CreateTask $taskDTO): Task {
        /** @var User $taskCreator */
        $taskCreator = $this->userRepository->findOrFail($taskDTO->creatorUuid);

        $task = new Task($taskDTO->title, $taskDTO->description, $taskCreator);

        $this->taskRepository->save($task);

        return $task;
    }
}