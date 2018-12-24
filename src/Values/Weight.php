<?php

namespace KielD01\ShipStation\Values;

use JsonSerializable;

class Weight implements JsonSerializable
{

    /** @var int */
    private static $value = 0;

    const POUNDS = 'pounds';
    const OUNCES = 'ounces';
    const GRAMS = 'grams';

    /** @var string */
    private static $unit = Weight::OUNCES;

    const UNITS = [
        Weight::OUNCES,
        Weight::POUNDS,
        Weight::GRAMS,
    ];

    /**
     * Weight constructor.
     * @param int $value
     * @param string $unit
     */
    public function __construct($value = 0, $unit = Weight::OUNCES)
    {
        if (in_array($unit, self::UNITS)) {
            self::$unit = $unit;
            self::$value = $value;
        }

        return $this->jsonSerialize();
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        return ['units' => self::$unit, 'value' => self::$value];
    }
}