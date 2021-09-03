<?php

namespace Trebla\ZipCode\Entities;

class ZipCodeEntity
{
    /**
     * @var string|NULL
     */
    public string|NULL $street;

    /**
     * @var string|NULL
     */
    public string|NULL $district;

    /**
     * @var string|NULL
     */
    public string|NULL $city;

    /**
     * @var string|NULL
     */
    public string|NULL $state;

    /**
     * @var string|NULL
     */
    public string|NULL $zipcode;

    /**
     * @var string|NULL
     */
    public string|NULL $country;


    public function __construct(
        ?string $street = NULL,
        ?string $district = NULL,
        ?string $city = NULL,
        ?string $state = NULL,
        ?string $zipcode = NULL,
        ?string $country = NULL
    ) {
        $this->street = $street;
        $this->district = $district;
        $this->city = $city;
        $this->state = $state;
        $this->zipcode = $zipcode;
        $this->country = $country;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            "street" => $this->street,
            "district" => $this->district,
            "city" => $this->city,
            "state" => $this->state,
            "zip_code" => $this->zipcode,
            "country" => $this->country,
        ];
    }
}
