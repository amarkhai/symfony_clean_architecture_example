<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use App\Domain\ValueObject\Email;
use App\Domain\ValueObject\FirstName;
use App\Domain\ValueObject\LastName;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Doctrine\UuidGenerator;

#[ORM\Entity]
class User
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface $uuid;

    #[ORM\Column(type: "string")]
    private FirstName $firstName;

    #[ORM\Column(type: "string")]
    private LastName $lastName;

    #[ORM\Column(type: "string")]
    private Email $email;

    #[ORM\Column(type: "datetimetz_immutable")]
    private \DateTimeImmutable $createdAt;

    #[ORM\Column(type: "boolean")]
    private bool $isActive;

    #[ORM\OneToMany(mappedBy: "creator", targetEntity: Task::class)]
    private Collection $createdTasks;

    #[ORM\OneToMany(mappedBy: "assignee", targetEntity: Task::class)]
    private Collection $assignedTasks;

    public function __construct(
        FirstName $firstName,
        LastName $lastName,
        Email $email
    )
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->createdAt = new \DateTimeImmutable();
        $this->isActive = true;
        $this->createdTasks = new ArrayCollection();
        $this->assignedTasks = new ArrayCollection();
    }

    public function getFirstName(): FirstName
    {
        return $this->firstName;
    }

    public function updateFirstName(FirstName $firstName): void
    {
        $this->firstName = $firstName;
    }

    public function getLastName(): LastName
    {
        return $this->lastName;
    }

    public function updateLastName(LastName $lastName): void
    {
        $this->lastName = $lastName;
    }

    public function getEmail(): Email
    {
        return $this->email;
    }

    public function updateEmail(Email $email): void
    {
        $this->email = $email;
    }

    public function isActive(): bool
    {
        return $this->isActive;
    }

    public function activate(): void
    {
        $this->isActive = true;
    }

    public function deactivate(): void
    {
        $this->isActive = false;
    }
}