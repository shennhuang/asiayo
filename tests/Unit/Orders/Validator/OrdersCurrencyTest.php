<?php

namespace Tests\Unit\Orders\Validator;

use App\Service\Orders\Validator\OrdersCurrencyValidator;
use PHPUnit\Framework\TestCase;

class OrdersCurrencyTest extends TestCase
{
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = new OrdersCurrencyValidator;
    }

    /**
     * 幣別為TWD應該要回應True
     */
    public function test_twd_should_be_accept(): void
    {
        // Arrange
        $inputValue = 'TWD';

        // Act
        $result = $this->validator->check($inputValue);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * 幣別為USD應該要回應True
     */
    public function test_usd_should_be_accept(): void
    {
        // Arrange
        $inputValue = 'USD';

        // Act
        $result = $this->validator->check($inputValue);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * 幣別為EUR應該要回應False
     */
    public function test_eur_should_not_be_accept(): void
    {
        // Arrange
        $inputValue = 'EUR';

        // Act
        $result = $this->validator->check($inputValue);

        // Assert
        $this->assertFalse($result);
    }
}
