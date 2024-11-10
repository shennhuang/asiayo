<?php

namespace Tests\Unit\Service\Orders;

use App\Service\Orders\Converter\UsdToTwdConverter;
use PHPUnit\Framework\TestCase;

class UsdToTwdConverterTest extends TestCase
{
    private $service;

    public function setUp(): void
    {
        parent::setUp();

        $this->service = new UsdToTwdConverter;
    }

    /**
     * 幣別為TWD應該要回應True
     */
    public function test_usd_should_be_convert(): void
    {
        // Arrange
        $inputValue = 50;
        $this->service->setPrice($inputValue);

        // Act
        $result = $this->service->convert($inputValue);

        // Assert
        $this->assertEquals(
            $inputValue * UsdToTwdConverter::USD_TO_TWD_EXCHANGE_RATE,
            $result
        );
    }
}
