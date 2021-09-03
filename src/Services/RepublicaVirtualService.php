<?php

namespace Trebla\ZipCode\Services;

use Exception;
use Illuminate\Http\Response;
use Trebla\ZipCode\Entities\ZipCodeEntity;
use Trebla\ZipCode\Helpers\WebServiceHelper;
use Trebla\ZipCode\Interfaces\HttpRequestServiceInterface;
use Trebla\ZipCode\Interfaces\RepublicaVirtualInterface;

class RepublicaVirtualService implements RepublicaVirtualInterface
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
        $baseUrl = WebServiceHelper::REPUBLICA_VIRTUAL_CEP_BASE_URL;

        try {
            $response = $this->service->get("{$baseUrl}{$zipcode}&formato=jsonp");

            if ($response->getStatusCode() === Response::HTTP_OK) {
                $json = json_decode($response->getBody()->getContents());

                if ($json->resultado !== "0") {
                    return new ZipCodeEntity(
                        "{$json->tipo_logradouro} {$json->logradouro}" ?? NULL,
                        $json->bairro ?? NULL,
                        $json->cidade ?? NULL,
                        $json->uf ?? NULL,
                        $json->cep ?? $zipcode,
                        $json->pais ?? NULL
                    );
                }
            }

            return response()->json(["ZipCode not found"]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
