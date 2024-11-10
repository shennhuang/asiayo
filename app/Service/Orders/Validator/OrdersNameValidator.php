<?php

namespace App\Service\Orders\Validator;

class OrdersNameValidator extends BaseOrdersValidator
{
    public int $failStatusCode = 400;
    public string $failMessage = 'Name contain non-English characters';

    public function check($value): bool
    {
        return preg_match('/^[A-Za-z]+$/', $value);
    }
}
