<?php

namespace KielD01\ShipStation\Models;

use KielD01\ShipStation\Traits\MagicConstructor;

/**
 * Class ListPackage
 * @package KielD01\Models
 * @property string carrierCode
 * @property string code
 * @property string name
 * @property bool domestic
 * @property bool international
 */
class ListPackage
{
    use MagicConstructor;
}