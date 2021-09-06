<?php

namespace Trebla\ZipCode;

use Exception;
use GuzzleHttp\Client;
use Trebla\ZipCode\Entities\ZipCodeEntity;
use Trebla\ZipCode\Helpers\ClientHelper;
use Trebla\ZipCode\Interfaces\ZipCodeInterface;
use Trebla\ZipCode\Services\PagarMeService;
use Trebla\ZipCode\Services\HttpRequestService;
use Trebla\ZipCode\Services\RepublicaVirtualService;
use Trebla\ZipCode\Services\ViaCepService;

class ZipCode implements ZipCodeInterface
{
    /** 
     * @var string 
     */
    protected string $option;

    /** 
     * @var PagarMeService|ViaCepService|RepublicaVirtualService
     */
    protected PagarMeService|ViaCepService|RepublicaVirtualService $service;

    /** 
     * @var HttpRequestService 
     */
    protected HttpRequestService $http;

    /** 
     * @var array 
     */
    protected array $services = [
        ClientHelper::PAGAR_ME => PagarMeService::class,
        ClientHelper::VIA_CEP => ViaCepService::class,
        ClientHelper::REPUBLICA_VIRTUAL => RepublicaVirtualService::class,
    ];

    public function __construct(
        ?string $option = ClientHelper::PAGAR_ME,
        ?HttpRequestService $http = NULL
    ) {
        $this->option = $option;
        $this->http = $http ?: new HttpRequestService(new Client());
        $this->service = $this->setClient($option);
    }

    /** 
     * @param string|null $option
     * @return PagarMeService|ViaCepService|RepublicaVirtualService
     */
    public function setClient(?string $option = NULL): PagarMeService|ViaCepService|RepublicaVirtualService
    {
        $this->validateOption($option);

        $this->service = new $this->services[$option ?? $this->option]($this->http);
        return $this->service;
    }

    /** 
     * @param string|null $option
     * @return void 
     */
    private function validateOption(?string $option = NULL): void
    {
        if (!array_key_exists($option ?? $this->option, $this->services))
            throw new Exception("Invalid service option was given.");
    }

    /**
     * @var string $zipcode
     * @return ZipCodeEntity
     */
    public function find(string $zipcode): ZipCodeEntity
    {
        return $this->service->find($zipcode);
    }
}
