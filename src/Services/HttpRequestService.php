<?php

namespace Trebla\ZipCode\Services;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Trebla\ZipCode\Interfaces\HttpRequestServiceInterface;

class HttpRequestService implements HttpRequestServiceInterface
{
    /**
     * @var Client
     */
    protected $service;

    public function __construct(Client $service)
    {
        $this->service = $service;
    }

    /**
     * @param string $url
     * @return ResponseInterface
     */
    public function get(string $url): ResponseInterface
    {
        return $this->service->get($url);
    }
}
