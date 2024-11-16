<?php

namespace App\Enums;

class DayOfWeekEnum
{
    public const SUNDAY = "sunday";
    public const MONDAY = "monday";
    public const TUESDAY = "tuesday";
    public const WEDNESDAY = "wednesday";
    public const THURSDAY = "thursday";
    public const FRIDAY = "friday";
    public const SATURDAY = "saturday";

    public static function getDaysOfWeek()
    {
        return [
            self::SUNDAY => 'Sunday',
            self::MONDAY => 'Monday',
            self::TUESDAY => 'Tuesday',
            self::WEDNESDAY => 'Wednesday',
            self::THURSDAY => 'Thursday',
            self::FRIDAY => 'Friday',
            self::SATURDAY => 'Saturday',
        ];
    }
}
