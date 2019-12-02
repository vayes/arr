<?php

namespace Vayes\Arr;

class ArrayStack extends AbstractStack
{
    /** @var array */
    protected $data;

    /** @var ArrayMeta */
    protected $meta;

    public function __construct($data)
    {
        $this->data = $data;
        $this->meta = new ArrayMeta($this->data);
    }
}
