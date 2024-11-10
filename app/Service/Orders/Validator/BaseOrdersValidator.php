<?php

namespace App\Service\Orders\Validator;

abstract class BaseOrdersValidator
{
    public int $failStatusCode;
    public string $failMessage;

    abstract function check($value): bool;
}
