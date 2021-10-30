<?php

declare(strict_types=1);

namespace Dev\Support\Dtos;

use ReflectionClass;

abstract class BaseDto
{
    /**
     * @param array $parameters
     */
    public function __construct(array $parameters = [])
    {
        $class = new ReflectionClass(static::class);
        $properties = $class->getProperties();
        foreach ($properties as $reflectionProperty) {
            $property = $reflectionProperty->getName();
            $this->{$property} = $parameters[$property];
        }
    }
}
