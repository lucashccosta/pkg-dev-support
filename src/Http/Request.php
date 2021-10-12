<?php

declare(strict_types=1);

namespace Dev\Support\Http;

use Dev\Support\Common\CloneArrayTrait;
use Dev\Support\Contracts\ICollection;
use Dev\Support\Contracts\IRequest;

class Request implements IRequest
{
    use CloneArrayTrait;

    /**
     * @var ICollection $collection
     */
    private $collection;

    /**
     * CollectionRequest constructor.
     *
     * @param ICollection $collection
     */
    public function __construct(ICollection $collection)
    {
        $this->collection = $collection;
    }

    /**
     * {@inheritDoc}
     */
    public function all(): array
    {
        return $this->collection->all();
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): self
    {
        $clone = clone $this;
        $clone->collection = $clone->collection->clear();

        return $clone;
    }

    /**
     * {@inheritDoc}
     */
    public function get(string $key, $default = null)
    {
        return $this->collection->get($key, $default);
    }

    /**
     * {@inheritDoc}
     */
    public function has(string $key): bool
    {
        return $this->collection->has($key);
    }

    /**
     * {@inheritDoc}
     */
    public function with(string $data, $key = null): self
    {
        $clone = clone $this;
        $clone->collection = $clone->collection->with($data, $key);

        return $clone;
    }

    /**
     * {@inheritDoc}
     */
    public function without(string $key): self
    {
        $clone = clone $this;
        $clone->collection = $clone->collection->without($key);

        return $clone;
    }
}
