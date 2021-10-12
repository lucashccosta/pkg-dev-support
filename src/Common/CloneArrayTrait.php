<?php

declare(strict_types=1);

namespace Dev\Support\Common;

trait CloneArrayTrait
{
    /**
     * Return a cloned array from an array reference.
     *
     * @param array $array
     *
     * @return array
     */
    public function cloneArray(array &$array): array
    {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $array[$key] = $this->cloneArray($value);
            }

            if (is_object($value)) {
                $array[$key] = clone $value;
            }
        }

        return $array;
    }
}
