<?php

namespace App\Contracts;

use App\Models\CourierShipment;

interface CourierInterface
{
    public function createOrder(array $orderData): array;
    public function checkStatus(CourierShipment $shipment): array;
}
