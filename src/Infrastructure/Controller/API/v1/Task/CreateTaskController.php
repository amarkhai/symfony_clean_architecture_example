<?php

declare(strict_types=1);

namespace App\Infrastructure\Controller\API\v1\Task;

use App\Application\DTO\Task\CreateTask;
use App\Application\UseCase\Task\TaskCreator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CreateTaskController extends AbstractController
{
    #[Route('/create', name: 'create', methods: ['POST'])]
    public function create(CreateTask $request, TaskCreator $taskCreator): Response
    {
        $task = $taskCreator($request);

        return new JsonResponse([
            'taskUuid' => $task->getUuid()->toString(),
            'title' => $task->getTitle(),
            'description' => $task->getDescription(),
            'creatorUuid' => $task->getCreator()->getUuid()->toString(),
            'createdAt' => $task->getCreatedAt()->format('Y-m-d H:i:s')
        ], 201);
    }
}