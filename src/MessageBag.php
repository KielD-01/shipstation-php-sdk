<?php

namespace KielD01\ShipStation;

/**
 * Class MessageBag
 * @package KielD01\ShipStation
 */
class MessageBag
{

    private static $errors = [];

    /**
     * @param null|string $error
     * @return int
     */
    public static function error($error = null)
    {
        return array_push(self::$errors, $error);
    }

    /**
     * @return array
     */
    public static function errors()
    {
        return self::$errors;
    }

    /**
     * @return bool
     */
    public static function hasErrors()
    {
        return (bool)count(self::$errors);
    }
}