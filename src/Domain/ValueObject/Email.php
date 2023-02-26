<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\IncorrectValueException;

class Email implements ValueObjectInterface
{
    private string $value;

    public function __construct(string $value)
    {
        if (!\preg_match('/^.+\@\S+\.\S+$/', $value)) {
            throw new IncorrectValueException('Incorrect email: ' . $value);
        }
        $this->value = $value;
    }

    public function equals(Email $email): bool
    {
        return $this->value === $email->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}