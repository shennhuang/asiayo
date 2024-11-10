<?php

namespace App\Service\Orders\Validator;

class OrdersCurrencyValidator extends BaseOrdersValidator
{
    public int $failStatusCode = 400;
    public string $failMessage = 'Currency formate is wrong';

    public function check($value): bool
    {
        return in_array($value, ['TWD', 'USD']);
    }
}
