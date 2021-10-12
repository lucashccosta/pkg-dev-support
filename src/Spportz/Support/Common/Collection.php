<?php

declare(strict_types=1);

namespace Spportz\Support\Http;

use Spportz\Support\Common\CloneArrayTrait;
use Spportz\Support\Contracts\ICollection;

class Collection implements ICollection
{
    use CloneArrayTrait;

    /**
     * Array of request parameters.
     *
     * @var array $items
     */
    private $items;

    /**
     * CollectionRequest constructor.
     *
     * @param array $items Populate the items.
     */
    public function __construct(array $items = [])
    {
        $this->items = $items;
    }

    /**
     * {@inheritDoc}
     */
    public function clear(): self
    {
        $clone = clone $this;
        $clone->items = [];

        return $clone;
    }

    /**
     * {@inheritDoc}
     */
    public function contains($item, bool $strict = true): bool
    {
        return in_array($item, $this->items, $strict);
    }

    /**
     * {@inheritDoc}
     */
    public function get($key, $default = null)
    {
        return $this->items[$key] ?? $default;
    }

    /**
     * {@inheritDoc}
     */
    public function has($key): bool
    {
        return isset($this->items[$key]);
    }

    /**
     * {@inheritDoc}
     */
    public function keys(): array
    {
        return array_keys($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function length(): int
    {
        return count($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function mergeWith(self...$collections): self
    {
        $clone = clone $this;
        foreach ($collections as $collection) {
            $clone->items = array_merge($clone->all(), $collection->all());
        }

        return $clone;
    }

    /**
     * @inheritdoc
     */
    public function all(): array
    {
        return $this->items;
    }

    /**
     * {@inheritDoc}
     */
    public function with($key, $item): self
    {
        $clone = clone $this;
        $clone->items[$key] = $item;

        return $clone;
    }

    /**
     * {@inheritDoc}
     */
    public function without($key): self
    {
        $clone = clone $this;
        unset($clone->items[$key]);

        return $clone;
    }

    /**
     * {@inheritDoc}
     */
    public function values(): array
    {
        return array_values($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function __clone()
    {
        $this->cloneArray($this->items);
    }

    /**
     * {@inheritDoc}
     */
    public function getIterator()
    {
        foreach ($this->items as $key => $item) {
            yield $key => $item;
        }
    }
}
