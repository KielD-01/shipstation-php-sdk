<?php

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
     * Returns list of the Rates for Carriers
     * @link https://shipstation.docs.apiary.io/#reference/shipments/get-rates/get-rates
     *
     * @param $carrierCode
     * @param $toPostalCode
     * @param $fromPostalCode
     * @param Weight $weight
     * @param null|string $toCountry
     * @param null|string $toState
     * @param null|string $toCity
     * @param null|string $packageCode
     * @param Dimensions|null $dimensions
     * @param null $confirmation
     * @param bool $residental
     * @return \KielD01\ShipStation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getRates(
        $carrierCode, $toPostalCode, $fromPostalCode, Weight $weight,
        $toCountry, $toState = null, $toCity = null, $packageCode = null,
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
                    'confirmation', 'residental', 'packageCode'
                )
            )
        );

        return $this->send(function ($item) {
            return new Shipment($item);
        });
    }

}