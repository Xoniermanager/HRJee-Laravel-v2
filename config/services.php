<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],
    'earnings' => [
            'BONUS',
            'INCENTIVE',
            'SPECIAL ALLOWANCE',
            'CONVEYANCE ALLOWANCE',
            'MEDICAL ALLOWANCE',
            'LEAVE TRAVEL ALLOWANCE (LTA)',
            'SHIFT ALLOWANCE',
            'ATTENDANCE ALLOWANCE',
            'PERFORMANCE ALLOWANCE',
            'OVERTIME',
            'ARREARS',
            'FESTIVAL BONUS',
            'PROJECT BONUS',
            'RETENTION BONUS',
            'REFERRAL BONUS',
            'RELOCATION ALLOWANCE',
            'MEAL COUPON ALLOWANCE',
            'CHILD EDUCATION ALLOWANCE',
            'CITY COMPENSATORY ALLOWANCE (CCA)',
            'UNIFORM ALLOWANCE',
            'WASHING ALLOWANCE',
            'TRAVEL REIMBURSEMENT',
            'PHONE REIMBURSEMENT',
            'INTERNET REIMBURSEMENT',
            'VEHICLE MAINTENANCE ALLOWANCE',
            'GIFT VOUCHERS',
            'AWARDS',
            'EX-GRATIA',
            'DA (DEARNESS ALLOWANCE)',
            'VARIABLE PAY',
            'OTHER EARNING',
            'DRIVER ALLOWANCE',
        ],
    'deductions' => [
            'PROVIDENT FUND (PF)',
            'PROFESSIONAL TAX (PT)',
            'TDS',                                        // Tax Deducted at Source
            'LOAN REPAYMENT',
            'ADVANCE SALARY',
            'LEAVE DEDUCTION',
            'LATE COMING DEDUCTION',
            'SHORT WORKING HOURS',
            'UNIFORM DEDUCTION',
            'FOOD COUPON DEDUCTION',
            'MEAL DEDUCTION',
            'NOTICE PAY RECOVERY',
            'DAMAGE/LOSS RECOVERY',
            'OTHER RECOVERY',
            'PENALTY',
            'CLUB MEMBERSHIP FEE',
            'INSURANCE PREMIUM (EMPLOYEE PORTION)',
            'VEHICLE LOAN REPAYMENT',
            'HOUSING LOAN REPAYMENT',
            'OTHER LOAN REPAYMENT',
            'OTHER DEDUCTION',
        ],

];
