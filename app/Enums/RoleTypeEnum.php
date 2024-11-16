<?php

namespace App\Enums;

use Spatie\Enum\Enum;

class RoleTypeEnum
{
    public const GLOBAL = "global";
    public const FEATURE = "feature";

    public static function getRoleType()
    {
        return [
            self::GLOBAL => 'global',
            self::FEATURE => 'feature',
        ];
    }
}
