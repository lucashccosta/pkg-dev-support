<?php

declare(strict_types=1);

namespace Dev\Support\Contracts;

interface ITransform
{   
    /**
     * @return array
     */
    public function transform(IArrayable $data): array;
}
