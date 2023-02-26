<?php

namespace App\Domain\ValueObject;

/**
 * @method equals
 */
interface ValueObjectInterface
{
    public function getValue(): mixed;
}