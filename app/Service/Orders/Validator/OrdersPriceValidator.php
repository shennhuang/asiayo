<?php

namespace App\Service\Orders\Validator;

class OrdersPriceValidator extends BaseOrdersValidator
{
    public int $priceThreshold = 2000;
    public int $failStatusCode = 400;
    public string $failMessage;

    public function __construct()
    {
        $this->failMessage = 'Price is Oever ' . $this->priceThreshold;
    }

    public function check($value): bool
    {
        return $value < $this->priceThreshold;
    }
}
