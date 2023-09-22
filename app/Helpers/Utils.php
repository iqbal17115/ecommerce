<?php

namespace App\Helpers;

class Utils
{
    /**
     * Is UUID Check
     *
     * @param $title
     * @return bool|int
     */
    public static function isUuid($title): bool|int
    {
        return preg_match('/^[0-9a-fA-F]{8}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{4}-[0-9a-fA-F]{12}$/', $title);
    }
}
