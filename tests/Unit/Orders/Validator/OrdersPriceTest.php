<?php

namespace Tests\Unit\Orders\Validator;

use App\Service\Orders\Validator\OrdersPriceValidator;
use PHPUnit\Framework\TestCase;

class OrdersPriceTest extends TestCase
{
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = new OrdersPriceValidator;
    }

    /**
     * 訂單金額低於門檻應該要回應True
     */
    public function test_order_price_should_less_than_threshold(): void
    {
        // Arrange
        $inputValue = $this->validator->priceThreshold - 10;

        // Act
        $result = $this->validator->check($inputValue);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * 訂單金額高於門檻應該要回應False
     */
    public function test_order_price_should_more_than_threshold(): void
    {
        // Arrange
        $inputValue = $this->validator->priceThreshold + 10;

        // Act
        $result = $this->validator->check($inputValue);

        // Assert
        $this->assertFalse($result);
    }
}
