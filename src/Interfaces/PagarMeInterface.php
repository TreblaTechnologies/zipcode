<?php

namespace Trebla\ZipCode\Interfaces;

use Trebla\ZipCode\Entities\ZipCodeEntity;

interface PagarMeInterface
{
    /**
     * @var string $zipcode
     * @return ZipCodeEntity
     */
    public function find(string $zipcode): ZipCodeEntity;
}
