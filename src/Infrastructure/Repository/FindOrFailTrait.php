<?php

declare(strict_types=1);

namespace App\Infrastructure\Repository;

use Doctrine\ORM\EntityNotFoundException;

trait FindOrFailTrait
{
    public function findOrFail(mixed $id, ?int $lockMode = null, ?int $lockVersion = null): object
    {
        $entity = $this->find($id, $lockMode, $lockVersion);

        if (!$entity) {
            throw EntityNotFoundException::fromClassNameAndIdentifier($this->getClassName(), [$id]);
        }

        return $entity;
    }

    public function findOneByOrFail(array $criteria, array $orderBy = null): object
    {
        $entity = $this->findOneBy($criteria, $orderBy);

        if (!$entity) {
            $fields = [];

            foreach ($criteria as $key => $value) {
                $fields[] = "$key = $value";
            }

            $fields = $fields ? implode(', ', $fields) : '';

            throw new EntityNotFoundException(\sprintf('Entity of type %s for fields [%s] was not found', $this->getClassName(), $fields));
        }

        return $entity;
    }
}
