<?php

declare(strict_types=1);

namespace Dev\Support\Transformers;

use Dev\Support\Common\Util;
use Dev\Support\Contracts\IArrayable;

class Collection extends BaseTransform
{   
    /**
     * {@inheritDoc}
     */
    public function transform(IArrayable $data): array
    {   
        $dataTransformed = [];
        foreach ($data->toArray() as $item) {
            $dataTransformed[] = Util::arrayOnly(
                $item->toArray(), 
                $this->mapper->mapping()
            );
        }
        
        return $dataTransformed;
    }
}
