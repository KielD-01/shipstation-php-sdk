<?php

namespace KielD01\ShipStation\Traits;

/**
 * Trait MagicConstructor
 * @package KielD01\ShipStation\Traits
 */
trait MagicConstructor
{
    /**
     * Model constructor.
     * @param array $model
     */
    public function __construct($model = [])
    {
        array_walk($model, function ($value, $key) {
            $this->__set($key, $value);
        });
    }

    /**
     * @param $name
     * @param $value
     */
    public function __set($name, $value)
    {
        $this->{$name} = $value;
    }

    /**
     * @param $name
     * @return mixed|null
     */
    public function __get($name)
    {
        return $this->{$name} ?? null;
    }
}