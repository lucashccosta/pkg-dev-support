<?php

declare(strict_types=1);

namespace Dev\Support\Common;

final class Util
{
    /**
     * @param array $data
     * @param array $keys
     * @return array
     */
    public static function arrayOnly(array $data, array $keys): array
    {
        $dataIndexes = array_keys($data);
        $keysIndexes = array_keys($keys);
        foreach ($dataIndexes as $item)
        {
            if (!in_array($item, $keysIndexes)) {
                unset($data[$item]);
            } else {
                if (is_callable($keys[$item])) {
                    $callable = $keys[$item];
                    $data[$item] = $callable($data[$item]);
                }
            }
        }

        return $data;
    }
}
