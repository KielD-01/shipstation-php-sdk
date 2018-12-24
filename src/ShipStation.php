<?php

namespace KielD01\ShipStation;

use GuzzleHttp\Client;

/**
 * Class ShipStation
 * @package KielD01\ShipStation
 */
abstract class ShipStation
{

    /** @var null|string */
    public static $apiKey = null;

    /** @var null|string */
    public static $apiSecret = null;

    /**
     * @var array
     */
    private static $hosts = [
        'production' => 'https://ssapi.shipstation.com',
        'mock' => 'https://private-anon-9385fa5016-shipstation.apiary-proxy.com',
        'debug' => 'https://private-anon-9385fa5016-shipstation.apiary-proxy.com'
    ];

    /**
     * @var string
     */
    private static $host = 'mock';

    /**
     * @var string
     */
    protected $method = 'get';

    /**
     * @var array
     */
    private $allowedMethods = [
        'get', 'post',
        'put', 'patch',
        'delete', 'head'
    ];

    /**
     * @var array
     */
    private $query = [];

    /**
     * @var array
     */
    private $endpoints = [
        'account.register' => '/accounts/registeraccount',
        'account.list.tags' => 'accounts/listtags',
        'carriers.list' => '/carriers',
        'carrier.get' => '/carriers/getcarrier',
        'shipments.rates' => '/shipments/getrates'
    ];

    /** @var Client */
    private $client;

    /**
     * @var null
     */
    private $endpoint = null;

    /**
     * Sets API Key
     *
     * @param null|string $key
     */
    public static function setApiKey($key = null)
    {
        self::$apiKey = $key;
    }

    /**
     * Sets API Secret
     *
     * @param null|string $secret
     */
    public static function setApiSecret($secret = null)
    {
        self::$apiSecret = $secret;
    }

    /**
     * @return string|null
     */
    public function getApiKey()
    {
        return self::$apiKey;
    }

    /**
     * @return string|null
     */
    public function getApiSecret()
    {
        return self::$apiSecret;
    }

    /**
     * @param null $method
     * @return bool|null
     */
    protected function setMethod($method = null)
    {
        if (!in_array($method, $this->allowedMethods)) {
            MessageBag::error("Method '{$method}' is not within allowable list");

            return false;
        }

        return $this->method = $method;
    }

    protected function setEndpointPath($path = null)
    {
        if (array_key_exists($path, $this->endpoints)) {
            return $this->endpoint = $this->endpoints[$path];
        }

        return MessageBag::error("Endpoint `{$path}` does not exists on the list");
    }

    /**
     * @param array $query
     */
    protected function setQuery($query = [])
    {
        $this->query = $query;
    }

    /**
     * @return string
     */
    private function getAuthorizationHeader()
    {
        return "Basic " . base64_encode("{$this->getApiKey()}:{$this->getApiSecret()}");
    }

    /**
     * @param null $callback
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function send($callback = null)
    {
        $response = null;

        $this->client = new Client([
            'base_uri' => self::$hosts[self::$host],
            'headers' => [
                'Authorization' => $this->getAuthorizationHeader(),
                'Accept' => 'application/json',
                'Content-Type' => 'application/json'
            ]
        ]);

        switch ($this->method) {
            case 'get':
            case 'head':
                $response = $this->client->get(
                    $this->endpoint . '?' . http_build_query($this->query)
                );
                break;
            case 'post':
            case 'put':
            case 'patch':
            case 'delete':
                $response = $this->client->request(
                    $this->method,
                    $this->endpoint,
                    [
                        'json' => $this->query
                    ]
                );
                break;
        }

        return new Response($response, $callback);
    }

    /**
     * @return array
     */
    public static function getHosts()
    {
        return self::$hosts;
    }

    /**
     * @param null|string $host
     * @return int|null
     */
    public static function setHost($host = null)
    {
        if (array_key_exists(self::$host, self::$hosts)) {
            return self::$host = $host;
        }

        return MessageBag::error("Host `{$host}` is not within the list");
    }
}