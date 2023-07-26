<?php

return [
    'envelopes' => [
        'from_area' => 0.000001,
        'to_area' => 0.00035, // Define your desired range for Envelopes
        'from_weight' => 0,
        'to_weight' => 1, // Define your desired weight range for Envelopes (in grams)
    ],
    'small_packages' => [
        'from_area' => 0.00036,
        'to_area' => 0.02700, // Define your desired range for Small Packages
        'from_weight' => 1.01,
        'to_weight' => 5, // Define your desired weight range for Small Packages (in grams)
    ],
    'medium_packages' => [
        'from_area' => 0.02701,
        'to_area' => 0.06400, // Define your desired range for Medium Packages
        'from_weight' => 5.01,
        'to_weight' => 10, // Define your desired weight range for Medium Packages (in grams)
    ],
    'large_packages' => [
        'from_area' => 0.06401,
        'to_area' => 0.28800, // Define your desired range for Large Packages
        'from_weight' => 10.01,
        'to_weight' => 20, // Define your desired weight range for Large Packages (in grams)
    ],
    'oversize_packages' => [
        'from_area' => 0.28801,
        'to_area' => 0.36000, // Define your desired range for Oversize Packages
        'from_weight' => 20.01,
        'to_weight' => 30, // Define your desired weight range for Oversize Packages (in grams)
    ],
    'large_or_heavy_packages' => [
        'from_area' => 0.36001,
        'to_area' => 0.50000, // Define your desired range for Large Or Heavy Packages
        'from_weight' => 30.01, // Define your desired range for Large Or Heavy Packages (in grams)
        'to_weight' => 50, // Define your desired weight range for Large Or Heavy Packages (in grams)
    ],
];

