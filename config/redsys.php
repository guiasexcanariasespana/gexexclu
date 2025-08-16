<?php
return [
    'key'                   => env('REDSYS_KEY', ''),

    'url_ok'                => env('REDSYS_URL_OK', ''),
    'url_ko'                => env('REDSYS_URL_KO', ''),

    'merchantcode'          => env('REDSYS_MERCHANT_CODE', ''),
    'terminal'              => env('REDSYS_TERMINAL', '1'),
    'enviroment'            => env('REDSYS_ENVIROMENT', 'test'),
    'url_notification'      => env('REDSYS_URL_NOTIFICATION', ''),

    'tradename'             => env('REDSYS_TRADENAME', ''),
    'titular' => env('REDSYS_TITULAR', ''),
    'description' => env('REDSYS_DESCRIPTION', '')
];
