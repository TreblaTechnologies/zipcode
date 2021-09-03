<?php

namespace Trebla\Package\Test;

use Exception;
use PHPUnit\Framework\TestCase;
use Trebla\ZipCode\Entities\ZipCodeEntity;
use Trebla\ZipCode\Helpers\ClientHelper;
use Trebla\ZipCode\ZipCode;

class ViaCepTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->service = new ZipCode(ClientHelper::VIA_CEP);
    }

    /** @test */
    public function it_should_not_find_an_invalid_zip_code()
    {
        $this->expectException(Exception::class);
        $this->service->find("99999-999");
    }

    /** @test */
    public function it_should_find_the_zip_code_information_by_a_given_valid_zip_code()
    {
        $response = $this->service->find("33040-130");

        $this->assertInstanceOf(ZipCodeEntity::class, $response);
    }
}
