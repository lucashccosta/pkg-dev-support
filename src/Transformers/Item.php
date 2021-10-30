<?php

declare(strict_types=1);

namespace Dev\Support\Transformers;

use Dev\Support\Common\Util;
use Dev\Support\Contracts\IArrayable;

final class Item extends BaseTransform
{   
    /**
     * {@inheritDoc}
     */
    public function transform(IArrayable $data): array 
    {   
        return Util::arrayOnly(
            $data->toArray(), 
            $this->mapper->mapping()
        );
    }
}
