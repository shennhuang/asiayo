<?php

namespace App\Service\Orders\Converter;

interface ConverterInterface
{
    public function setPrice(int $price): void;
    public function convert(): int;
}
