<?php

namespace Trebla\Package\Test;

use PHPUnit\Framework\TestCase;
use Trebla\ZipCode\Interfaces\ZipCodeInterface;
use Trebla\ZipCode\ZipCode;

class ClientTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        $this->client = new ZipCode();
    }

    /** @test */
    public function it_should_be_a_client_instance()
    {
        $this->assertInstanceOf(ZipCodeInterface::class, $this->client);
    }
}
