<?php

namespace Tests\Feature\Orders;

use App\Service\Orders\Converter\UsdToTwdConverter;
use App\Service\Orders\Validator\OrdersNameValidator;
use Illuminate\Testing\Fluent\AssertableJson;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Tests\TestCase;

class OrdersApiConvertTest extends TestCase
{
    /**
     * 測試合法格式
     */
    public function test_legal_formate_should_reponse_success(): void
    {
        // Arrange
        $inputData = [
            "id" => "A0000001",
            "name" => "ABCD",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "1999",
            "currency" => "TWD",
        ];

        // Act
        $response = $this->postJson('/api/orders', $inputData);

        // Assert
        $response->assertStatus(200);
    }

    /**
     * 測試名字不合規情境
     */
    public function test_name_illegal_should_response_fail(): void
    {
        // Arrange
        $failMessage = (new OrdersNameValidator)->failMessage;
        $this->withoutExceptionHandling();
        $this->expectException(HttpException::class);
        $this->expectExceptionMessage($failMessage);

        $inputData = [
            "id" => "A0000001",
            "name" => "123456",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "1999",
            "currency" => "TWD",
        ];

        // Act
        $this->post('/api/orders', $inputData);
    }

    /**
     * 測試輸入美金的情境
     */
    public function test_input_usd_should_convert_to_twd(): void
    {
        // Arrange
        $inputData = [
            "id" => "A0000001",
            "name" => "ABCD",
            "address" => [
                "city" => "taipei-city",
                "district" => "da-an-district",
                "street" => "fuxing-south-road"
            ],
            "price" => "1999",
            "currency" => "USD",
        ];

        // Act
        $response = $this->postJson('/api/orders', $inputData);

        // Assert
        $response
            ->assertStatus(200)
            ->assertJson(function (AssertableJson $json) use ($inputData) {
                $json
                    ->where('id', $inputData['id'])
                    ->where('name', $inputData['name'])
                    ->where('address', $inputData['address'])
                    ->where('price', UsdToTwdConverter::USD_TO_TWD_EXCHANGE_RATE * $inputData['price'])
                    ->where('currency', 'TWD');
            });
    }
}
