<?php
/**
 * Created by PhpStorm.
 * User: roman
 * Date: 2018-12-24
 * Time: 16:00
 */

namespace KielD01\ShipStation\Requests;


use KielD01\ShipStation\Models\Shipment;
use KielD01\ShipStation\ShipStation;
use KielD01\ShipStation\Values\Dimensions;
use KielD01\ShipStation\Values\Weight;

/**
 * Class Shipments
 * @package KielD01\ShipStation\Requests
 */
class Shipments extends ShipStation
{

    /**
     * @param $carrierCode
     * @param $toPostalCode
     * @param $fromPostalCode
     * @param Weight $weight
     * @param null $toState
     * @param null $toCountry
     * @param null $toCity
     * @param Dimensions|null $dimensions
     * @param null $confirmation
     * @param bool $residental
     * @return \KielD01\ShipStation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRates(
        $carrierCode, $toPostalCode, $fromPostalCode, Weight $weight,
        $toCountry, $toState = null, $toCity = null,
        Dimensions $dimensions = null, $confirmation = null, $residental = false
    )
    {
        $this->setMethod('post');
        $this->setEndpointPath('shipments.rates');

        $weight = $weight instanceof Weight ?
            $weight->jsonSerialize() :
            null;

        $dimensions = $dimensions instanceof Dimensions ?
            $dimensions->jsonSerialize() :
            null;

        $this->setQuery(
            array_filter(
                compact(
                    'carrierCode', 'toPostalCode', 'fromPostalCode',
                    'weight', 'toState', 'toCountry', 'toCity', 'dimensions',
                    'confirmation', 'residental'
                )
            )
        );


        return $this->send(function ($item) {
            return new Shipment($item);
        });
    }

}