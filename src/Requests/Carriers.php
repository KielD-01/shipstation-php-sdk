<?php

namespace KielD01\ShipStation\Requests;

use KielD01\ShipStation\MessageBag;
use KielD01\ShipStation\Models\Carrier;
use KielD01\ShipStation\ShipStation;

/**
 * Class Carriers
 * @package KielD01\ShipStation\Requests
 */
class Carriers extends ShipStation
{

    /**
     * @return \KielD01\ShipStation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function list()
    {
        $this->setMethod('get');
        $this->setEndpointPath('carriers.list');

        return $this->send(function ($carrier) {
            return new Carrier($carrier);
        });
    }

    /**
     * @param null $carrierCode
     * @return int|\KielD01\ShipStation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function carieer($carrierCode = null)
    {
        if (!$carrierCode) {
            return MessageBag::error("Carrier code can't be null");
        }

        $this->setMethod('get');
        $this->setEndpointPath('carrier.get');
        $this->setQuery(compact('carrierCode'));

        return $this->send(Carrier::class);
    }

    /**
     * @param null|string $carrierCode
     * @param float $amount
     */
    public function addFunds($carrierCode = null, float $amount = 0.00)
    {
        $this->setMethod('post');


        if (!$carrierCode) {
            MessageBag::error('Carrier code can\'t be null');
        }

        if (!in_array($amount, [10.00, 10000.00])) {
            MessageBag::error('Amount should be not less than $10.00 and not much $10,000.00');
        }


    }
}