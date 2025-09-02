<?php

namespace App\Contracts;

interface CourierInterface
{
    public function createOrder(array $orderData): array;
}
