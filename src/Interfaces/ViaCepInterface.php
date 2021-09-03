<?php

namespace Trebla\ZipCode\Interfaces;

use Trebla\ZipCode\Entities\ZipCodeEntity;

interface ViaCepInterface
{
    /**
     * @var string $zipcode
     * @return ZipCodeEntity
     */
    public function find(string $zipcode): ZipCodeEntity;
}
