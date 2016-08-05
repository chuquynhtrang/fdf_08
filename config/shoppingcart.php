<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Shopping Cart
    |--------------------------------------------------------------------------
    |
    | Config file
    | If you have installed market package, productPricesValues and shippingPricesValues translations are defined on market config file
    |
    */

    // Tax default values
    'taxDefaultCountry'             => env('TAX_DEFAULT_COUNTRY', 'ES'),
    'taxDefaultCustomerClass'       => env('TAX_DEFAULT_CUSTOMER_CLASS', 1),

    // 1 excluding tax, 2 including tax
    'taxProductPrices'              => env('TAX_PRODUCT_PRICES', 1),
    'taxShippingPrices'             => env('TAX_SHIPPING_PRICES', 1),
];
