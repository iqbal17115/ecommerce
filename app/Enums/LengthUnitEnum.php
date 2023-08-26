<?php

namespace App\Enums;

class LengthUnitEnum
{
    public const DM = 'dm';
    public const MM = 'mm';
    public const CM = 'cm';
    public const M = 'm';
    public const ANGSTROM = 'angstrom';
    public const MIL = 'mil';
    public const YD = 'yd';
    public const PM = 'pm';
    public const MILE = 'mile';
    public const IN = 'in';
    public const FT = 'ft';
    public const HIN = 'hin';
    public const NM = 'nm';
    public const μM = 'μm';
    public const KM = 'km';

    public static function getOptions()
    {
        return [
            self::DM => 'Decimeter',
            self::MM => 'Milimeter',
            self::CM => 'Centimeter',
            self::M => 'Meter',
            self::ANGSTROM => 'Angstrom',
            self::MIL => 'Mil',
            self::YD => 'Yards',
            self::PM => 'Picometer',
            self::MILE => 'Mile',
            self::IN => 'Inch',
            self::FT => 'Feet',
            self::HIN => 'Hundredths Inch',
            self::NM => 'Nanometer',
            self::μM => 'Micrometre',
            self::KM => 'Kilometers',
        ];
    }
}
