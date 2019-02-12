<?php

namespace KielD01\ShipStation\Values;

use KielD01\ShipStation\Models\Country;

/**
 * Class Countries
 * @package KielD01\ShipStation\Values
 */
final class Countries
{

    /**
     * Returns list of countries
     *
     * @return array
     */
    public static function list()
    {
        $list = [];

        if (($handle = fopen(__DIR__ . '/data/countriesCodes.csv', "r")) !== FALSE) {
            $row = 1;

            while (($country = fgetcsv($handle, 1000, ",")) !== FALSE) {
                if ($row > 1) {
                    $list[] = new Country($country);
                }

                $row++;
            }

            fclose($handle);
        }

        return $list;
    }
}