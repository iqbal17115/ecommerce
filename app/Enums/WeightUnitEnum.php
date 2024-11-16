<?php

namespace App\Enums;

class WeightUnitEnum
{
    public const LB = 'lb';
    public const KG = 'kg';
    public const GM = 'gm';
    public const HLB = 'hlb';
    public const MG = 'mg';
    public const TN = 'tn';
    public const OZ = 'oz';

    public static function getWeightOptions()
    {
        return [
            self::LB => 'Pound',
            self::KG => 'Kilogram',
            self::GM => 'Gram',
            self::HLB => 'Hundredths Pounds',
            self::MG => 'Milligram',
            self::TN => 'Ton',
            self::OZ => 'Ounce',
        ];
    }
}

