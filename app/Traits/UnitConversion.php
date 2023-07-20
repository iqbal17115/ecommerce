<?php

namespace App\Traits;

use InvalidArgumentException;

trait UnitConversion
{

    public function convertWeightTo(float $weight, string $targetUnit, string $fromUnit): float
    {
        // First, convert the weight to kilograms (base unit)
        switch ($fromUnit) {
            case 'lb':
                $weight = $weight * 0.453592; // 1 pound = 0.453592 kilograms
                break;
            case 'gm':
                $weight = $weight * 0.001; // 1 gram = 0.001 kilograms
                break;
            case 'hlb':
                $weight = $weight * 0.0453592; // 1 hundredweight = 0.0453592 kilograms
                break;
            case 'mg':
                $weight = $weight * 1e-6; // 1 milligram = 1e-6 kilograms
                break;
            case 'tn':
                $weight = $weight * 1000; // 1 metric ton = 1000 kilograms
                break;
            case 'oz':
                $weight = $weight * 0.0283495; // 1 ounce = 0.0283495 kilograms
                break;
            default:
                // If the unit is already in kilograms, do nothing
                break;
        }

        // Now, convert the weight from kilograms to the target unit
        switch ($targetUnit) {
            case 'lb':
                return $weight * 2.20462; // 1 kilogram = 2.20462 pounds
            case 'kg':
                return $weight; // 1 kilogram = 1 kilogram
            case 'gm':
                return $weight * 1000; // 1 kilogram = 1000 grams
            case 'hlb':
                return $weight * 22.0462; // 1 kilogram = 22.0462 hundredweights
            case 'mg':
                return $weight * 1e+6; // 1 kilogram = 1e+6 milligrams
            case 'tn':
                return $weight * 0.001; // 1 kilogram = 0.001 metric tons (tonnes)
            case 'oz':
                return $weight * 35.27396; // 1 kilogram = 35.27396 ounces
            default:
                return $weight; // Return as it is (unit is already in target unit)
        }
    }



    /**
     * Length conversion from base unit (meter) to target unit.
     *
     * @param float $length
     * @param string $targetUnit
     * @return float
     */
    public function convertLengthTo(float $length, string $fromUnit, string $targetUnit): float
    {
        // Convert input length to meters based on the 'fromUnit'
        switch ($fromUnit) {
            case 'dm':
                $length /= 10; // 1 meter = 10 decimeters
                break;
            case 'mm':
                $length /= 1000; // 1 meter = 1000 millimeters
                break;
            case 'cm':
                $length /= 100; // 1 meter = 100 centimeters
                break;
            case 'angstrom':
                $length /= 1e10; // 1 meter = 1e10 angstroms
                break;
            case 'mil':
                $length /= 39370.1; // 1 meter = 39370.1 mils
                break;
            case 'yd':
                $length /= 1.09361; // 1 meter = 1.09361 yards
                break;
            case 'pm':
                $length /= 1e12; // 1 meter = 1e12 picometers
                break;
            case 'mile':
                $length /= 0.000621371; // 1 meter = 0.000621371 miles
                break;
            case 'in':
                $length /= 39.3701; // 1 meter = 39.3701 inches
                break;
            case 'ft':
                $length /= 3.28084; // 1 meter = 3.28084 feet
                break;
            case 'hin':
                $length /= 393.701; // 1 meter = 393.701 hundredths inches
                break;
            case 'nm':
                $length /= 1e9; // 1 meter = 1e9 nanometers
                break;
            case 'um':
                $length /= 1e6; // 1 meter = 1e6 micrometers
                break;
            case 'km':
                $length /= 0.001; // 1 meter = 0.001 kilometers
                break;
            // 'm' is already in meters, so no conversion needed
            case 'm':
                break;
            default:
                throw new InvalidArgumentException('Invalid source unit.');
        }

        // Convert the length in meters to the desired 'targetUnit'
        switch ($targetUnit) {
            case 'dm':
                return $length * 10; // 1 meter = 10 decimeters
            case 'mm':
                return $length * 1000; // 1 meter = 1000 millimeters
            case 'cm':
                return $length * 100; // 1 meter = 100 centimeters
            case 'angstrom':
                return $length * 1e10; // 1 meter = 1e10 angstroms
            case 'mil':
                return $length * 39370.1; // 1 meter = 39370.1 mils
            case 'yd':
                return $length * 1.09361; // 1 meter = 1.09361 yards
            case 'pm':
                return $length * 1e12; // 1 meter = 1e12 picometers
            case 'mile':
                return $length * 0.000621371; // 1 meter = 0.000621371 miles
            case 'in':
                return $length * 39.3701; // 1 meter = 39.3701 inches
            case 'ft':
                return $length * 3.28084; // 1 meter = 3.28084 feet
            case 'hin':
                return $length * 393.701; // 1 meter = 393.701 hundredths inches
            case 'nm':
                return $length * 1e9; // 1 meter = 1e9 nanometers
            case 'um':
                return $length * 1e6; // 1 meter = 1e6 micrometers
            case 'km':
                return $length * 0.001; // 1 meter = 0.001 kilometers
            case 'm':
                return $length; // 1 meter = 1 meter (no conversion needed)
            default:
                throw new InvalidArgumentException('Invalid target unit.');
        }
    }


}
