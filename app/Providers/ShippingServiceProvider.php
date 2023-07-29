<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ShippingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $shippingChargeClasses = [
            'Envelopes' => [
                [
                    'name' => 'small_envelope',
                    'from_area' => 0.000001,
                    'to_area' => 0.000035,
                    'from_weight' => 0,
                    'to_weight' => 1000,
                ],
                [
                    'name' => 'standard_envelope',
                    'from_area' => 0.000036,
                    'to_area' => 0.000100,
                    'from_weight' => 1001,
                    'to_weight' => 2000,
                ],
            ],
            'Small Packages' => [
                [
                    'name' => 'small_package_1',
                    'from_area' => 0.000101,
                    'to_area' => 0.001000,
                    'from_weight' => 1001,
                    'to_weight' => 2000,
                ],
                [
                    'name' => 'small_package_2',
                    'from_area' => 0.000101,
                    'to_area' => 0.001000,
                    'from_weight' => 2001,
                    'to_weight' => 3000,
                ],
                [
                    'name' => 'small_package_3',
                    'from_area' => 0.001001,
                    'to_area' => 0.002700,
                    'from_weight' => 3001,
                    'to_weight' => 4000,
                ],
                [
                    'name' => 'small_package_4',
                    'from_area' => 0.001001,
                    'to_area' => 0.002700,
                    'from_weight' => 4001,
                    'to_weight' => 5000,
                ],
            ],
            'Medium Packages' => [
                [
                    'name' => 'medium_Package_1',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 5001,
                    'to_weight' => 6000,
                ],
                [
                    'name' => 'medium_Package_2',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 6001,
                    'to_weight' => 7000,
                ],
                [
                    'name' => 'medium_Package_3',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 7001,
                    'to_weight' => 8000,
                ],
                [
                    'name' => 'medium_Package_4',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 8001,
                    'to_weight' => 9000,
                ],
                [
                    'name' => 'medium_Package_5',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 9001,
                    'to_weight' => 10000,
                ],
                [
                    'name' => 'medium_Package_6',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 10001,
                    'to_weight' => 11000,
                ],
                [
                    'name' => 'medium_Package_7',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 11001,
                    'to_weight' => 12000,
                ],
                [
                    'name' => 'medium_Package_8',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 12001,
                    'to_weight' => 13000,
                ],
                [
                    'name' => 'medium_Package_9',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 13001,
                    'to_weight' => 14000,
                ],
                [
                    'name' => 'medium_Package_10',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 14001,
                    'to_weight' => 15000,
                ],
                [
                    'name' => 'medium_Package_11',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 15001,
                    'to_weight' => 16000,
                ],
                [
                    'name' => 'medium_Package_12',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 16001,
                    'to_weight' => 17000,
                ],
                [
                    'name' => 'medium_Package_13',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 18001,
                    'to_weight' => 19000,
                ],
                [
                    'name' => 'medium_Package_14',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 19001,
                    'to_weight' => 20000,
                ],
            ],
            'Large Packages' => [
                [
                    'name' => 'large_package_1',
                    'from_area' => 0.008001,
                    'to_area' => 0.028800,
                    'from_weight' => 20001,
                    'to_weight' => 21000,
                ],
                [
                    'name' => 'large_package_2',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 21001,
                    'to_weight' => 22000,
                ],
                [
                    'name' => 'large_package_3',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 22001,
                    'to_weight' => 23000,
                ],
                [
                    'name' => 'large_package_4',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 23001,
                    'to_weight' => 24000,
                ],
                [
                    'name' => 'large_package_5',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 24001,
                    'to_weight' => 25000,
                ],
                [
                    'name' => 'large_package_6',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 25001,
                    'to_weight' => 26000,
                ],
                [
                    'name' => 'large_package_7',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 26001,
                    'to_weight' => 27000,
                ],
                [
                    'name' => 'large_package_8',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 27001,
                    'to_weight' => 28000,
                ],
                [
                    'name' => 'large_package_9',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 28001,
                    'to_weight' => 29000,
                ],
                [
                    'name' => 'large_package_10',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 29001,
                    'to_weight' => 30000,
                ],
            ],
            'Oversize Packages' => [
                [
                    'name' => 'oversize_package_1',
                    'from_area' => 0.040001,
                    'to_area' => 0.050000,
                    'from_weight' => 30001,
                    'to_weight' => 35000,
                ],
                [
                    'name' => 'oversize_package_2',
                    'from_area' => 0.050001,
                    'to_area' => 0.100000,
                    'from_weight' => 35001,
                    'to_weight' => 40000,
                ],
                [
                    'name' => 'oversize_package_3',
                    'from_area' => 0.050001,
                    'to_area' => 0.100000,
                    'from_weight' => 40001,
                    'to_weight' => 45000,
                ],
                [
                    'name' => 'oversize_package_4',
                    'from_area' => 0.050001,
                    'to_area' => 0.100000,
                    'from_weight' => 45001,
                    'to_weight' => 50000,
                ],
            ],
            'Large Or Heavy Packages' => [
                [
                    'name' => 'large_or_heavy_package_1',
                    'from_area' => 0.100001,
                    'to_area' => 0.250000,
                    'from_weight' => 50001,
                    'to_weight' => 60000,
                ],
                [
                    'name' => 'large_or_heavy_package_2',
                    'from_area' => 0.100001,
                    'to_area' => 0.250000,
                    'from_weight' => 60001,
                    'to_weight' => 70000,
                ],
                [
                    'name' => 'large_or_heavy_package_3',
                    'from_area' => 0.100001,
                    'to_area' => 0.250000,
                    'from_weight' => 70001,
                    'to_weight' => 80000,
                ],
            ],
        ];

        // Merge the shipping charge classes into the existing configuration
        config(['shipping.charge_classes' => $shippingChargeClasses]);
    }
}
