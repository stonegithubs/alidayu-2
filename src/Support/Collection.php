<?php

namespace Mingyoung\Alidayu\Support;

use ArrayAccess;

class Collection implements ArrayAccess
{
    protected $items = [];

    /**
     * Collection constructor.
     *
     * @param array $items
     */
    public function __construct(array $items)
    {
        $this->items = $items;
    }

    /**
     * Run a map over each of the items.
     *
     * @param callable $callback
     *
     * @return static
     */
    public function map(callable $callback)
    {
        $keys = array_keys($this->items);
        $items = array_map($callback, $this->items, $keys);

        return new static(array_combine($keys, $items));
    }

    public function offsetExists($offset)
    {
    }

    public function offsetGet($offset)
    {
    }

    public function offsetSet($offset, $value)
    {
    }

    public function offsetUnset($offset)
    {
    }
}
