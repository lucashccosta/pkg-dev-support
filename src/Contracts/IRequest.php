<?php

namespace Dev\Support\Contracts;

interface IRequest
{
    /**
     * Return all the data.
     *
     * @return array
     */
    public function all(): array;

    /**
     * Remove all the data.
     *
     * @return self
     */
    public function clear(): self;

    /**
     * Return the value of required key.
     * Default if is not found.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed|null
     */
    public function get(string $key, $default = null): mixed;

    /**
     * Return true if key is set, otherwise false.
     *
     * @param mixed $key
     *
     * @return bool
     */
    public function has(string $key): bool;

    /**
     * Return a request with a new data value.
     *
     * @param string $key
     * @param mixed $item
     *
     * @return self
     */
    public function add(string $key, mixed $item): self;

    /**
     * Return a request without a specific key.
     *
     * @param mixed $key
     *
     * @return self
     */
    public function remove(string $key): self;
}
