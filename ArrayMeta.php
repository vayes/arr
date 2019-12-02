<?php

namespace Vayes\Arr;

class ArrayMeta implements \ArrayAccess
{
    /** @var int */
    private $count;

    /** @var int */
    private $firstIndex;

    /** @var mixed */
    private $firstKey;

    /** @var mixed */
    private $firstValue;

    /** @var int */
    private $lastIndex;

    /** @var mixed */
    private $lastKey;

    /** @var mixed */
    private $lastValue;

    /** @var array */
    protected $data;

    public function __construct(&$data)
    {
        $this->data = &$data;
        $this->count = count($this->data);

        if($this->count)
        {
            $this->firstKey   = array_key_first($this->data);
            $this->lastKey    = array_key_last($this->data);
            $this->firstIndex = 0;
            $this->lastIndex  = $this->count - 1;
            $this->firstValue = $this->data[$this->firstKey];
            $this->lastValue  = $this->data[$this->lastKey];
        }
    }

    /**
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

    /**
     * @return int
     */
    public function getFirstIndex(): int
    {
        return $this->firstIndex;
    }

    /**
     * @return mixed
     */
    public function getFirstKey()
    {
        return $this->firstKey;
    }

    /**
     * @return mixed
     */
    public function getFirstValue()
    {
        return $this->firstValue;
    }

    /**
     * @return int
     */
    public function getLastIndex(): int
    {
        return $this->lastIndex;
    }

    /**
     * @return mixed
     */
    public function getLastKey()
    {
        return $this->lastKey;
    }

    /**
     * @return mixed
     */
    public function getLastValue()
    {
        return $this->lastValue;
    }

    public function offsetSet($offset, $value) {
        if (is_null($offset)) {
            $this->data[] = $value;
        } else {
            $this->data[$offset] = $value;
        }
    }

    public function offsetExists($offset) {
        return isset($this->data[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->data[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->data[$offset]) ? $this->data[$offset] : null;
    }
}
