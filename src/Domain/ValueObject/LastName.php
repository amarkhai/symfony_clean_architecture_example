<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\IncorrectValueException;

class LastName implements ValueObjectInterface
{
    private string $value;

    public function __construct(string $value)
    {
        if (!\preg_match('/^[a-zA-Zа-яА-Я]+$/iu', $value)) {
            throw new IncorrectValueException('Incorrect lastname: ' . $value);
        }
        $this->value = $value;
    }

    public function equals(LastName $lastName): bool
    {
        return $this->value === $lastName->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}