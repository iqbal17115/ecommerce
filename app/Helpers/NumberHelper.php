<?php

namespace App\Helpers;

class NumberHelper
{
    public static function convertToInteger($value)
    {
        return floor(floatval($value)); 
    }
}
