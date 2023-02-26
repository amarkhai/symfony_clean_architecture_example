<?php

declare(strict_types=1);

namespace App\Domain\ValueObject;

use App\Domain\Exception\IncorrectValueException;

class FirstName implements ValueObjectInterface
{
    private string $value;

    public function __construct(string $value)
    {
        if (!\preg_match('/^[a-zA-Zа-яА-Я]+$/iu', $value)) {
            throw new IncorrectValueException('Incorrect firstname: ' . $value);
        }
        $this->value = $value;
    }

    public function equals(FirstName $firstName): bool
    {
        return $this->value === $firstName->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }
}