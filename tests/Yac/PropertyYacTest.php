<?php

namespace Yac;

class PropertyYacTest extends YacTest
{
    protected function get($name)
    {
        return $this->yac->$name;
    }

    protected function doIsset($name)
    {
        return isset($this->yac->$name);
    }

    protected function doUnset($name)
    {
        unset($this->yac->$name);
    }
}
