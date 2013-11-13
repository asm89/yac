<?php

namespace Yac;

use ArrayAccess;
use InvalidArgumentException;

class Yac implements ArrayAccess
{
    private $__yac = array();

    public function & __get($id)
    {
        if ( ! isset($this->__yac[$id])) {
            throw new InvalidArgumentException(sprintf('Identifier "%s" is not defined.', $id));
        }

        $this->$id = (is_object($this->__yac[$id]) && method_exists($this->__yac[$id], '__invoke'))
            ? $this->__yac[$id]($this)
            : $this->__yac[$id];

        return $this->$id;
    }

    public function __isset($id)
    {
        return array_key_exists($id, $this->__yac);
    }

    public function __unset($id)
    {
        unset($this->$id);
        unset($this->__yac[$id]);
    }

    public function offsetExists($id)
    {
        return $this->__isset($id);
    }

    public function offsetGet($id)
    {
        return $this->$id;
    }

    public function offsetSet($id, $value)
    {
        $this->__yac[$id] = $value;
    }

    public function offsetUnset($id)
    {
        $this->__unset($id);
    }
}
