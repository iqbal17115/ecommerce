<?php

namespace App\Services;

use App\Contracts\CourierInterface;
use App\Services\Couriers\SteadfastCourier;
use App\Services\Couriers\PathaoCourier;
use InvalidArgumentException;

class CourierFactory
{
    public static function make(string $courier): CourierInterface
    {
        return match ($courier) {
            'steadfast' => new SteadfastCourier(),
            default     => throw new InvalidArgumentException("Unsupported courier: $courier"),
        };
    }
}
