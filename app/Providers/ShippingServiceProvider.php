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
                    'to_weight' => 5000,
                ],
                [
                    'name' => 'small_package_2',
                    'from_area' => 0.001001,
                    'to_area' => 0.002700,
                    'from_weight' => 5001,
                    'to_weight' => 10000,
                ],
            ],
            'Medium Packages' => [
                [
                    'name' => 'medium_Package_1',
                    'from_area' => 0.002701,
                    'to_area' => 0.006400,
                    'from_weight' => 10001,
                    'to_weight' => 15000,
                ],
                [
                    'name' => 'medium_package_2',
                    'from_area' => 0.006401,
                    'to_area' => 0.008000,
                    'from_weight' => 15001,
                    'to_weight' => 20000,
                ],
            ],
            'Large Packages' => [
                [
                    'name' => 'large_package_1',
                    'from_area' => 0.008001,
                    'to_area' => 0.028800,
                    'from_weight' => 20001,
                    'to_weight' => 25000,
                ],
                [
                    'name' => 'large_package_2',
                    'from_area' => 0.028801,
                    'to_area' => 0.040000,
                    'from_weight' => 25001,
                    'to_weight' => 30000,
                ],
            ],
            'Oversize Packages' => [
                [
                    'name' => 'oversize_package_1',
                    'from_area' => 0.040001,
                    'to_area' => 0.050000,
                    'from_weight' => 30001,
                    'to_weight' => 40000,
                ],
                [
                    'name' => 'oversize_package_2',
                    'from_area' => 0.050001,
                    'to_area' => 0.100000,
                    'from_weight' => 40001,
                    'to_weight' => 50000,
                ],
            ],
            'Large Or Heavy Packages' => [
                [
                    'name' => 'large_or_heavy_package_1',
                    'from_area' => 0.100001,
                    'to_area' => 0.250000,
                    'from_weight' => 50001,
                    'to_weight' => 80000,
                ],
            ],
        ];

        // // Load the shipping charge classes from the configuration file
        // $shippingChargeClasses = [
        //     'Envelopes' => [
        //         [
        //             'name' => 'Small Envelope',
        //             'from_area' => 0.000001,
        //             'to_area' => 0.00035,
        //             'from_weight' => 0,
        //             'to_weight' => 1000,
        //         ],
        //         [
        //             'name' => 'Standard Envelope',
        //             'from_area' => 0.00036,
        //             'to_area' => 0.00050,
        //             'from_weight' => 1001,
        //             'to_weight' => 2000,
        //         ],
        //         // Add more sets of dimension and weight criteria for 'Envelopes' className if needed
        //     ],
        //     'Small Packages' => [
        //         [
        //             'name' => 'Small Package 1',
        //             'from_area' => 0.00036,
        //             'to_area' => 0.02700,
        //             'from_weight' => 1000.01,
        //             'to_weight' => 5000,
        //         ],
        //         [
        //             'name' => 'Small Package 2',
        //             'from_area' => 0.02701,
        //             'to_area' => 0.03500,
        //             'from_weight' => 5000.01,
        //             'to_weight' => 10000,
        //         ],
        //         // Add more sets of dimension and weight criteria for 'Small Packages' className if needed
        //     ],
        //     'Medium Packages' => [
        //         [
        //             'name' => 'Medium Package 1',
        //             'from_area' => 0.02701,
        //             'to_area' => 0.06400,
        //             'from_weight' => 5000.01,
        //             'to_weight' => 10000,
        //         ],
        //         [
        //             'name' => 'Medium Package 2',
        //             'from_area' => 0.06401,
        //             'to_area' => 0.08000,
        //             'from_weight' => 10001,
        //             'to_weight' => 15000,
        //         ],
        //         // Add more sets of dimension and weight criteria for 'Medium Packages' className if needed
        //     ],
        //     'Large Packages' => [
        //         [
        //             'name' => 'Large Package 1',
        //             'from_area' => 0.06401,
        //             'to_area' => 0.28800,
        //             'from_weight' => 10000.01,
        //             'to_weight' => 20000,
        //         ],
        //         [
        //             'name' => 'Large Package 2',
        //             'from_area' => 0.28801,
        //             'to_area' => 0.40000,
        //             'from_weight' => 20001,
        //             'to_weight' => 30000,
        //         ],
        //         // Add more sets of dimension and weight criteria for 'Large Packages' className if needed
        //     ],
        //     'Oversize Packages' => [
        //         [
        //             'name' => 'Oversize Package 1',
        //             'from_area' => 0.28801,
        //             'to_area' => 0.36000,
        //             'from_weight' => 20000.01,
        //             'to_weight' => 30000,
        //         ],
        //         [
        //             'name' => 'Oversize Package 2',
        //             'from_area' => 0.36001,
        //             'to_area' => 0.48000,
        //             'from_weight' => 30001,
        //             'to_weight' => 40000,
        //         ],
        //         // Add more sets of dimension and weight criteria for 'Oversize Packages' className if needed
        //     ],
        //     'Large Or Heavy Packages' => [
        //         [
        //             'name' => 'Large Or Heavy Package 1',
        //             'from_area' => 0.36001,
        //             'to_area' => 0.50000,
        //             'from_weight' => 30000.01,
        //             'to_weight' => 50000,
        //         ],
        //         // Add more sets of dimension and weight criteria for 'Large Or Heavy Packages' className if needed
        //     ],
        // ];



        // Merge the shipping charge classes into the existing configuration
        config(['shipping.charge_classes' => $shippingChargeClasses]);
    }
}
