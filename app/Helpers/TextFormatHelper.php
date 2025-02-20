<?php

namespace App\Helpers;

class TextFormatHelper
{
    /**
     * Format Number
     *
     * @param [type] $amount
     * @return void
     */
    public static function formatText(string $text): string
    {
        // Replace underscores with spaces and capitalize each word
        return ucwords(str_replace('_', ' ', strtolower($text)));
    }

    /**
     * Format a number with comma as thousands separator.
     *
     * @param float|int $quantity The quantity to format.
     * @return string The formatted quantity.
     */
    public static function formatQuantity($quantity)
    {
        // Format the number with comma as thousands separator
        return number_format((float)$quantity);
    }
}