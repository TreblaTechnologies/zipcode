<?php

namespace Trebla\ZipCode;

use Exception;
use GuzzleHttp\Client;
use Trebla\ZipCode\Entities\ZipCodeEntity;
use Trebla\ZipCode\Helpers\ClientHelper;
use Trebla\ZipCode\Interfaces\ZipCodeInterface;
use Trebla\ZipCode\Services\PagarMeService;
use Trebla\ZipCode\Services\HttpRequestService;

class ZipCode implements ZipCodeInterface
{
    /** 
     * @var string 
     */
    protected string $option;

    /** 
     * @var PagarMeService 
     */
    protected PagarMeService $service;


    /** 
     * @var HttpRequestService 
     */
    protected HttpRequestService $http;

    /** 
     * @var array 
     */
    protected array $services = [
        ClientHelper::PAGAR_ME => PagarMeService::class,
    ];

    public function __construct(
        ?string $option = ClientHelper::PAGAR_ME,
        ?Client $http = NULL
    ) {
        $this->option = $option;
        $this->http = $http ?: new HttpRequestService(new Client());
        $this->service = $this->instantiateServiceClient($option);
    }

    /** 
     * @return PagarMeService
     */
    private function instantiateServiceClient(): PagarMeService
    {
        $this->validateOption();

        return new $this->services[$this->option]($this->http);
    }

    /** 
     * @return void 
     */
    private function validateOption(): void
    {
        if (!array_key_exists($this->option, $this->services))
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
