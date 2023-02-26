<?php

declare(strict_types=1);

namespace App\Application\Gateway\Repository;

interface FindOrFailInterface
{
    public function findOrFail(mixed $id, ?int $lockMode = null, ?int $lockVersion = null): object;
    public function findOneByOrFail(array $criteria, array $orderBy = null): object;
}
