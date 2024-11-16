<?php

return [
    "date_format" => 'd M Y',

    /**
     * Notify Email Lists
     */
    'log_notify_emails' => env('LOG_NOTIFY_EMAILS'),

    /**
     * All Access Related Configurations
     */
    'access' => [
        /**
         * Determines the login max attempts
         */
        'max_attempts' => env('ACCESS_MAX_ATTEMPTS', 5),

        /**
         * The duration for which login is blocked after reaching the maximum attempts.
         */
        'blocked_until_in_minutes' => env('ACCESS_BLOCKED_UNTIL_IN_MINUTES', 1),

        /**
         * The maximum allowed time difference for the login verification.
         */
        'max_minutes_difference' => env('ACCESS_MAX_MINUTES_DIFFERENCE', 1),

        /**
         * The expiration time for the verification code.
         */
        'expiration_time_in_minutes' => env('LOGIN_VERIFY_EXPIRATION_TIME_IN_MINUTES', 10),

        /**
         * The expiration time for the 2fa cookie
         */
        '2fa_cookie_expiration_days' => env('TWO_FACTOR_EXPIRATION_DAYS', 40),
    ],

    /**
     * Account Category
     */
    'transaction_account_category_name' => [
        'expense_from_account' => ['Bank', 'Cash'],
        'expense_to_account' => ['Expense'],
        'revenue_from_account' => ['Revenue'],
        'revenue_to_account' => ['Bank', 'Cash'],
        'money_transfer_from_account' => ['Bank', 'Cash'],
        'money_transfer_to_account' => ['Bank', 'Cash']
    ],

    /**
     * Account Name
     */
    'transaction_account_name' => [
        'commission_debit_account_name' => 'Commission Receivable',
        'commission_credit_account_name' => 'Commission Revenue',
        'sale_debit_account_name' => 'Account Receivable',
        'sale_credit_account_name' => 'Products & Goods'
    ],
];
