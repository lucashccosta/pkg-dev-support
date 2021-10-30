<?php

declare(strict_types=1);

namespace Dev\Support\Transformers;

use Dev\Support\Contracts\IMappable;
use Dev\Support\Contracts\ITransform;
use Exception;

abstract class BaseTransform implements ITransform
{   
    protected IMappable $mapper;

    /**
     * @param string $mappableClass
     */
    public function __construct(
        private string $mappableClass
    ) {
        if (!class_exists($mappableClass)) {
            throw new Exception('Mappable class not found.');
        }

        $this->mapper = new $mappableClass();
    }
}
