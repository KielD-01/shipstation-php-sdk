<?php

namespace KielD01\ShipStation\Requests;

use Exception;
use KielD01\ShipStation\Models\ListPackage;
use KielD01\ShipStation\ShipStation;

/**
 * Class ListPackages
 * @package KielD01\ShipStation\Requests
 */
class ListPackages extends ShipStation
{

    /**
     * Returns a list of the packages for the specific carrier
     * @link https://shipstation.docs.apiary.io/#reference/carriers/list-packages/list-packages
     *
     * @param string|null $carrierCode
     * @return \KielD01\ShipStation\Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws Exception
     */
    public function list($carrierCode = null)
    {

        if (!$carrierCode) {
            throw new Exception('Carrier code cannot be empty');
        }

        $this->setMethod('get');
        $this->setEndpointPath('list.packages');
        $this->setQuery(compact('carrierCode'));

        return $this->send(function ($listPackage) {
            return new ListPackage($listPackage);
        });
    }
}