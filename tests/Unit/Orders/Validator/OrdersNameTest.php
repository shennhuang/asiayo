<?php

namespace Tests\Unit\Orders\Validator;

use App\Service\Orders\Validator\OrdersNameValidator;
use PHPUnit\Framework\TestCase;

class OrdersNameTest extends TestCase
{
    private $validator;

    public function setUp(): void
    {
        parent::setUp();

        $this->validator = new OrdersNameValidator;
    }

    /**
     * 幣別為TWD應該要回應True
     */
    public function test_english_name_should_be_accept(): void
    {
        // Arrange
        $inputValue = 'ABCDefg';

        // Act
        $result = $this->validator->check($inputValue);

        // Assert
        $this->assertTrue($result);
    }

    /**
     * 幣別為USD應該要回應True
     */
    public function test_non_english_should_not_be_accept(): void
    {
        // Arrange
        $inputValue = '中文名字';

        // Act
        $result = $this->validator->check($inputValue);

        // Assert
        $this->assertFalse($result);
    }
}
