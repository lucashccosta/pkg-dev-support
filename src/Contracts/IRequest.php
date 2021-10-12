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
     * @return IRequest
     */
    public function clear(): self;

    /**
     * Return the value of required key.
     * Default if is not found.
     *
     * @param mixed $key
     * @param mixed|null $default
     *
     * @return mixed
     */
    public function get(string $key, $default = null);

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
     * @param mixed $data
     * @param mixed $key
     *
     * @return IRequest
     */
    public function with(string $data, $key = null): self;

    /**
     * Return a request without a specific key.
     *
     * @param mixed $key
     *
     * @return IRequest
     */
    public function without(string $key): self;
}
