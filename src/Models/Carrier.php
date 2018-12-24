<?php

namespace KielD01\ShipStation\Models;

use KielD01\ShipStation\Traits\MagicConstructor;

/**
 * Class Carrier
 * @package KielD01\Models
 * @property string name
 * @property string code
 * @property string accountNumber
 * @property bool requiresFundedAccount
 * @property double balance
 * @property string nickname
 * @property integer shippingProviderId
 * @property bool primary
 */
class Carrier
{
    use MagicConstructor;
}