<?php

declare(strict_types=1);

namespace Dev\Support\Contracts;

interface IMappable
{   
    /**
     * @return array
     */
    public function mapping(): array;
}
