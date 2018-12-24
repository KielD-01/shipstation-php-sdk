<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2018-12-24
 * Time: 16:11
 */

namespace KielD01\ShipStation\Models;

use KielD01\ShipStation\Traits\MagicConstructor;

/**
 * Class Shipment
 * @package KielD01\ShipStation\Models
 * @property string serviceName
 * @property string serviceCode
 * @property double shipmentCost
 * @property double otherCost
 */
class Shipment
{
    use MagicConstructor;
}