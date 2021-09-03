<?php

namespace Trebla\ZipCode\Services;

use Exception;
use Illuminate\Http\Response;
use Trebla\ZipCode\Entities\ZipCodeEntity;
use Trebla\ZipCode\Helpers\WebServiceHelper;
use Trebla\ZipCode\Interfaces\HttpRequestServiceInterface;
use Trebla\ZipCode\Interfaces\ViaCepInterface;

class ViaCepService implements ViaCepInterface
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
        $baseUrl = WebServiceHelper::VIA_CEP_BASE_URL;

        try {
            $response = $this->service->get("{$baseUrl}/{$zipcode}/json");

            if ($response->getStatusCode() === Response::HTTP_OK) {
                $json = json_decode($response->getBody()->getContents());
                $array = (array) $json;

                if (!array_key_exists('erro', $array)) {
                    return new ZipCodeEntity(
                        $array['logradouro'] ?? NULL,
                        $array['bairro'] ?? NULL,
                        $array['localidade'] ?? NULL,
                        $array['uf'] ?? NULL,
                        $array['cep'] ?? $zipcode,
                        $array['pais'] ?? NULL
                    );
                }
            }

            return response()->json(["ZipCode not found"]);
        } catch (Exception $exception) {
            throw new Exception($exception->getMessage());
        }
    }
}
