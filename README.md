# ZipCode PHP

A PHP library to search the address data for a given zip code.

# Getting Started

## Installation

Using Composer:

``` bash
composer require trebla/zipcode
```

## How to use

You can search for a zip code passing it as a parameter to `find()` method:

``` php
use Trebla\ZipCode\ZipCode;
use Trebla\ZipCode\Entities\ZipCodeEntity;

public function getAddress(string $zipcode): ZipCodeEntity
{
    return ZipCode::find($zipcode);
}
```

You also can choose the zip code service passing it as a parameter to `find()` method:

``` php
use Trebla\ZipCode\ZipCode;
use Trebla\ZipCode\Entities\ZipCodeEntity;
use Trebla\ZipCode\Helpers\ZipCodeHelper;

public function getAddress(string $zipcode): ZipCodeEntity
{
    return ZipCode::find($zipcode, ZipCodeHelper::VIA_CEP);
}
```

## Services available

| Service | Constant |
| ------ | ------ |
| Pagar me | `ZipCodeHelper::PAGAR_ME` |
| Repúblic Virtual | `ZipCodeHelper::REPUBLICA_VIRTUAL` |
| Via CEP | `ZipCodeHelper::VIA_CEP` |
