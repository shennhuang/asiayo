<?php

namespace App\Service\Orders\Converter;

class UsdToTwdConverter implements ConverterInterface
{
    const USD_TO_TWD_EXCHANGE_RATE = 31;

    private $price;
    public function __construct(int $price = null)
    {
        $this->price = $price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function convert(): int
    {
        return $this->price * self::USD_TO_TWD_EXCHANGE_RATE;
    }
}
