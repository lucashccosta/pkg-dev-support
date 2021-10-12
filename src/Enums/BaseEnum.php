<?php

declare(strict_types=1);

namespace Dev\Support\Enums;

use InvalidArgumentException;
use ReflectionClass;

abstract class BaseEnum
{
    protected $value;

    public function __construct($value)
    {
        $constants = static::getAllowedValues();

        if (!in_array($value, $constants, true)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The value "%s" is not available in %s',
                    $value,
                    static::class
                )
            );
        }

        $this->value = $value;
    }

    public static function __callStatic(string $value, array $args = []): self
    {
        $constants = static::getAllowedValues();

        if (!array_key_exists($value, $constants)) {
            throw new InvalidArgumentException(
                sprintf(
                    'The key "%s" is not available in %s',
                    $value,
                    static::class
                )
            );
        }

        return new static($constants[$value]);
    }

    public static function getAllowedValues(): array
    {
        $self = new ReflectionClass(static::class);

        return $self->getConstants();
    }

    // abstract public function equals(self $enum): bool;

    public function __toString(): string
    {
        return (string) $this->getValue();
    }

    public function getValue()
    {
        return $this->value;
    }
}
