<?php

namespace Trebla\ZipCode\Services;

use Exception;
use Illuminate\Http\Response;
use Trebla\ZipCode\Entities\ZipCodeEntity;
use Trebla\ZipCode\Helpers\WebServiceHelper;
use Trebla\ZipCode\Interfaces\HttpRequestServiceInterface;
use Trebla\ZipCode\Interfaces\PagarMeInterface;

class PagarMeService implements PagarMeInterface
{
    /**
     * @var HttpRequestServiceInterface
     */
    protected HttpRequestServiceInterface $service;

    public function __construct(HttpRequestServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * @var string $zipcode
     * @return ZipCodeEntity
     */
    public function find(string $zipcode): ZipCodeEntity
    {
        $baseUrl = WebServiceHelper::PAGAR_ME_ZIPCODES_BASE_URL;

        try {
            $response = $this->service->get("{$baseUrl}/{$zipcode}");

            if ($response->getStatusCode() === Response::HTTP_OK) {
                $json = json_decode($response->getBody()->getContents());

                return new ZipCodeEntity(
                    $json->street ?? NULL,
                    $json->neighborhood ?? NULL,
                    $json->city ?? NULL,
                    $json->state ?? NULL,
                    $json->zipcode ?? $zipcode,
                    $json->country ?? NULL
                );
            } else {
                return response()->json(["ZipCode not Found"]);
            }
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
