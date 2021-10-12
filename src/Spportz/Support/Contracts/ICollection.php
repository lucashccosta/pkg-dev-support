<?php

declare(strict_types=1);

namespace Spportz\Support\Contracts;

use IteratorAggregate;

interface ICollection extends IteratorAggregate
{
    /**
     * Return all the items.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Remove all the items.
     *
     * @return ICollection
     */
    public function clear(): self;

    /**
     * Return true if collection contains the required value, otherwise return false.
     *
     * @param mixed $item
     * @param bool $strict
     *
     * @return bool
     */
    public function contains($item, bool $strict = true): bool;

    /**
     * Return the value of required key.
     * Default if is not found.
     *
     * @param mixed $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function get($key, $default = null);

    /**
     * Return true if key is set, otherwise false.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function has($key): bool;

    /**
     * Return an array containing all the collection's keys.
     *
     * @return array
     */
    public function keys(): array;

    /**
     * Return the number of items.
     *
     * @return int
     */
    public function length(): int;

    /**
     * Return a Collection merging it with one or more collection.
     *
     * @param ICollection[] $collection
     *
     * @return ICollection
     */
    public function mergeWith(self ...$collection): self;

    /**
     * Return a Collection with a new item value.
     *
     * @param mixed $key
     * @param mixed $item
     *
     * @return ICollection
     */

    public function with($key, $item): self;

    /**
     * Return a Collection without a specific key.
     *
     * @param mixed $key
     *
     * @return ICollection
     */
    public function without($key): self;

    /**
     * Return an array containing all the collection's items.
     *
     * @return array
     */
    public function values(): array;

    /**
     * Return a new cloned object
     * It's recommended to deep clone the object
     *
     * @return ICollection
     */
    public function __clone(): self;
}
