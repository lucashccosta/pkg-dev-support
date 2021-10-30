<?php

declare(strict_types=1);

namespace Dev\Support\Contracts;

interface IArrayable
{   
    /**
     * @return array
     */
    public function toArray(): array;
}
