<?php

namespace Trebla\ZipCode\Interfaces;

use Trebla\ZipCode\Entities\ZipCodeEntity;
use Trebla\ZipCode\Services\PagarMeService;
use Trebla\ZipCode\Services\RepublicaVirtualService;
use Trebla\ZipCode\Services\ViaCepService;

interface ZipCodeInterface
{
    /** 
     * @param string|null $option
     * @return PagarMeService|ViaCepService|RepublicaVirtualService
     */
    public function setClient(?string $option = NULL): PagarMeService|ViaCepService|RepublicaVirtualService;

    /**
     * @var string $zipcode
     * @return ZipCodeEntity
     */
    public function find(string $zipcode): ZipCodeEntity;
}
