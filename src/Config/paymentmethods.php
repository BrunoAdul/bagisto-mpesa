<?php

return [
    'mpesa'  => [
        'code'        => 'mpesa',
        'title'       => 'M-Pesa',
        'description' => 'Pay with M-Pesa mobile money',
        'class'       => 'Bruno\Mpesa\Payment\Mpesa',
        'active'      => true,
        'sort'        => 8,
    ],
];