<?php

declare(strict_types=1);

namespace App\Domain\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

#[ORM\Entity]
class Task
{
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: UuidGenerator::class)]
    private UuidInterface $uuid;

    #[ORM\Column(type: "string", length: 50)]
    private string $title;

    #[ORM\Column(type: "text")]
    private string $description;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "createdTasks")]
    #[ORM\JoinColumn(name: "creator_uuid", referencedColumnName: "uuid")]
    private User $creator;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: "assignedTasks")]
    #[ORM\JoinColumn(name: "assignee_uuid", referencedColumnName: "uuid")]
    private ?User $assignee = null;

    #[ORM\Column(type: "datetimetz_immutable")]
    private \DateTimeImmutable $createdAt;

    /**
     * @param string $title
     * @param string $description
     * @param User $creator
     */
    public function __construct(string $title, string $description, User $creator)
    {
        $this->title = $title;
        $this->description = $description;
        $this->creator = $creator;
        $this->createdAt = new \DateTimeImmutable();
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function updateTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function updateDescription(string $description): void
    {
        $this->description = $description;
    }

    public function getCreator(): User
    {
        return $this->creator;
    }

    public function getAssignee(): ?User
    {
        return $this->assignee;
    }

    public function changeAssignee(User $assignee): void
    {
        $this->assignee = $assignee;
    }
}