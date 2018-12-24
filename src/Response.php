<?php

namespace KielD01\ShipStation;

use Carbon\Carbon;
use Closure;
use Psr\Http\Message\ResponseInterface;

/**
 * Class Response
 * @package KielD01\ShipStation
 */
class Response
{

    /**
     * @var ResponseInterface
     */
    private $response;

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var int
     */
    private $requestsLimitRate = 0;

    /**
     * @var int
     */
    private $limitRemains = 0;

    /**
     * @var Carbon
     */
    private $limitReset = 0;

    /**
     * @var int
     */
    private $responseCode = 200;

    /**
     * @var array
     */
    private $data = [];

    /**
     * @var array
     */
    private $okCodes = [
        200, 201, 204
    ];

    /**
     * @var array
     */
    private $failCodes = [
        400, 401, 403,
        404, 405, 429,
        500
    ];

    /**
     * Response constructor.
     * @param ResponseInterface $response
     * @param null $closure
     */
    public function __construct(ResponseInterface $response, $closure = null)
    {
        $this->response = $response;
        $this->headers = $response->getHeaders();

        $this->setLimitRate()
            ->setRemainingLimit()
            ->setLimitReset()
            ->setHttpCode()
            ->setData($closure);
    }

    /**
     * @return $this
     */
    private function setLimitRate()
    {
        $this->requestsLimitRate = (int)current($this->headers['X-Rate-Limit-Limit']);

        return $this;
    }

    /**
     * @return $this
     */
    private function setRemainingLimit()
    {
        $this->limitRemains = (int)current($this->headers['X-Rate-Limit-Remaining']);

        return $this;
    }

    /**
     * @return $this
     */
    private function setLimitReset()
    {
        $this->limitReset = Carbon::createFromTimestamp(
            time() + (int)current($this->headers['X-Rate-Limit-Reset'])
        );

        return $this;
    }

    /**
     * @return $this
     */
    private function setHttpCode()
    {
        $this->responseCode = $this->response->getStatusCode();

        return $this;
    }

    /**
     * @param null $closureOrClass
     * @return $this
     */
    private function setData($closureOrClass = null)
    {
        $this->data = json_decode(
            $this->response->getBody()->getContents(), 1
        );

        if ($closureOrClass instanceof Closure or is_callable($closureOrClass) or $closureOrClass) {
            switch (is_string($closureOrClass)) {
                case true:
                    $this->data = new $closureOrClass($this->data);
                    break;
                case false:
                    $this->data = array_map($closureOrClass, $this->data);
                    break;
            }
        }

        return $this;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return int
     */
    public function getLimitRate()
    {
        return $this->requestsLimitRate;
    }

    /**
     * @return int
     */
    public function getRemainingLimit()
    {
        return $this->limitRemains;
    }

    /**
     * @return int
     */
    public function getLimitResetTime()
    {
        return $this->limitReset;
    }

    /**
     * @return int
     */
    public function getHttpCode()
    {
        return $this->responseCode;
    }

}