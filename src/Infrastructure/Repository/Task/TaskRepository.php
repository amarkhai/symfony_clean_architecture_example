<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository\Task;

use App\Application\Gateway\Repository\Task\TaskRepositoryInterface;
use App\Infrastructure\Repository\FindOrFailTrait;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityNotFoundException;

class TaskRepository extends ServiceEntityRepository implements TaskRepositoryInterface
{
    use FindOrFailTrait;
    public function save(object $object): void
    {
        $this->getEntityManager()->persist($object);
        $this->getEntityManager()->flush();
    }

    public function delete(string $id): void
    {
        $user = $this->find($id);
        if (\is_null($user)) {
            throw new EntityNotFoundException('Task with id=' . $id . ' is not found');
        }
        $this->getEntityManager()->remove($user);
    }
}