<?php

namespace Trebla\ZipCode\Interfaces;

use Trebla\ZipCode\Entities\ZipCodeEntity;

interface RepublicaVirtualInterface
{
    /**
     * @var string $zipcode
     * @return ZipCodeEntity
     */
    public function find(string $zipcode): ZipCodeEntity;
}
