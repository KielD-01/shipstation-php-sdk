<?php

namespace KielD01\ShipStation\Traits;

/**
 * Trait Casts
 * @package KielD01\ShipStation\Traits
 * @property array casts
 */
trait Casts
{

    public function cast() {
        foreach ($this->casts as $field => $type) {
            switch ($type){
                case 'int':
                case 'integer':
                    $this->{$field} = (int)$this->{$field};
                    break;
                case 'bool':
                case 'boolean':
                    $this->{$field} = (bool)$this->{$field};
                    break;
            }
        }
    }

}