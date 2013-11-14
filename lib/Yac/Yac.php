<?php

namespace Yac;

use ArrayAccess;
use InvalidArgumentException;

/**
 * Yet another container
 */
class Yac implements ArrayAccess
{
    /**
     * @var array
     */
    private $__yac = array();

    /**
     * @param  string|int $id
     * @return mixed
     */
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

    /**
     * @param  string|int $id
     * @return boolean
     */
    public function __isset($id)
    {
        return array_key_exists($id, $this->__yac);
    }

    /**
     * @param string|int $id
     */
    public function __unset($id)
    {
        unset($this->$id);
        unset($this->__yac[$id]);
    }

    /**
     * @param  string|int $id
     * @return boolean
     */
    public function offsetExists($id)
    {
        return $this->__isset($id);
    }

    /**
     * @param  string|int $id
     * @return mixed
     */
    public function offsetGet($id)
    {
        return $this->$id;
    }

    /**
     * @param string|int $id
     * @param mixed      $value
     */
    public function offsetSet($id, $value)
    {
        $this->__yac[$id] = $value;
    }

    /**
     * @param string|int $id
     */
    public function offsetUnset($id)
    {
        $this->__unset($id);
    }
}
