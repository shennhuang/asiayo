<?php

namespace App\Service\Orders;

use App\Service\Orders\Converter\CurrencyConverterAdapter;
use App\Service\Orders\Validator\OrdersValidatorAdapter;

class OrdersService
{
    public function validate(array $inputData): void
    {
        $ordersCheckerAdapter = new OrdersValidatorAdapter;
        foreach ($inputData as $fieldName => $value) {
            $validator = $ordersCheckerAdapter->getOrdersValidator($fieldName);
            if ($validator) {
                $validator->check($value) ?: abort($validator->failStatusCode, $validator->failMessage);
            }
        }
    }

    public function convert(string $currency, int $price): int
    {
        $convertedPrice = $price;
        if ($currency !== 'TWD') {
            $converter = (new CurrencyConverterAdapter($currency, $price))->get();
            $convertedPrice = $converter->convert();
        }
       return $convertedPrice;
    }
}
