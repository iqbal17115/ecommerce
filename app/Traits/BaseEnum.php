<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait BaseEnum
{
    /**
     * All Lists
     */
    public static function all(): Collection
    {
        return collect(self::cases())->map(
            fn (self $code) => $code->details()
        );
    }

    /**
     * Get Values
     */
    public static function getValues(): array
    {
        $enumsArr = self::cases();
        return array_column($enumsArr, 'value');
    }
}
