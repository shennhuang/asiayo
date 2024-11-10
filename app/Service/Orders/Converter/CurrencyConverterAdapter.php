<?php

namespace App\Service\Orders\Converter;

class CurrencyConverterAdapter
{
    private $currency;
    private $price;

    public function __construct(string $currency, int $price)
    {
        $this->currency = $currency;
        $this->price = $price;
    }

    public function get(): ConverterInterface
    {
        switch ($this->currency) {
            case 'USD':
                $converter = new UsdToTwdConverter($this->price);
                break;
            }
            return $converter;
    }
}
