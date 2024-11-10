<?php

namespace App\Service\Orders\Validator;

class OrdersValidatorAdapter
{
    public function getOrdersValidator(string $fieldName): ?BaseOrdersValidator
    {
        $validator = null;
        switch ($fieldName) {
        case 'name':
            $validator = new OrdersNameValidator;
            break;
        case 'price':
            $validator = new OrdersPriceValidator;
            break;
        case 'currency':
            $validator = new OrdersCurrencyValidator;
            break;
        }
        return $validator;
    }
}
