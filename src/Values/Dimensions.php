<?php

namespace KielD01\ShipStation\Values;

use JsonSerializable;

/**
 * Class Dimensions
 * @package KielD01\ShipStation\Values
 */
class Dimensions implements JsonSerializable
{
    /**
     * @var int
     */
    private static $length = 0;

    /**
     * @var int
     */
    private static $width = 0;

    /**
     * @var int
     */
    private static $height = 0;

    const INCHES = 'inches';
    const CENTIMETERS = 'centimeters';

    /**
     * @var string
     */
    private static $unit = Dimensions::INCHES;

    const UNITS = [
        Dimensions::INCHES,
        Dimensions::CENTIMETERS
    ];

    /**
     * Dimensions constructor.
     * @param int $length
     * @param int $width
     * @param int $height
     * @param string $unit
     */
    public function __construct($length = 0, $width = 0, $height = 0, $unit = Dimensions::INCHES)
    {

        if (in_array($unit, self::UNITS)) {
            self::$length = $length;
            self::$width = $width;
            self::$height = $height;
            self::$unit = $unit;
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
        return [
            'length' => self::$length,
            'width' => self::$width,
            'height' => self::$height,
            'unit' => self::$unit
        ];
    }
}