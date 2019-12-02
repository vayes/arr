<?php

namespace Vayes\Arr;

abstract class AbstractStack
{
    /** @var array */
    protected $data;

    /** @var ArrayMeta */
    protected $meta;

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }

    /**
     * @param array $data
     */
    public function setData(array $data): void
    {
        $this->data = $data;
    }

    /**
     * @return ArrayMeta
     */
    public function getMeta(): ArrayMeta
    {
        return $this->meta;
    }

    public function loop(\Closure $closure)
    {
        return $closure($this->data, $this->meta);
    }
}
