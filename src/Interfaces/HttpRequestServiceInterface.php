<?php

namespace Trebla\ZipCode\Interfaces;

use Psr\Http\Message\ResponseInterface;

interface HttpRequestServiceInterface
{
    /**
     * @var string $url
     * @return ResponseInterface
     */
    public function get(string $url): ResponseInterface;
}
