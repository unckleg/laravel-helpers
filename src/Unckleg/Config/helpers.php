<?php return [

    /*
    |--------------------------------------------------------------------------
    | Resolve
    |--------------------------------------------------------------------------
    |
    | Set true to action if you want provider to register action helpers
    | on the app boot. You can also set view to false if you want just to use
    | Action helpers within your application.
    |
    */
    'resolve' => [
        'view'   => true,
        'action' => true
    ],

    /*
    |--------------------------------------------------------------------------
    | Package Helpers
    |--------------------------------------------------------------------------
    |
    | The package helpers listed here will be automatically loaded on the
    | boot of your application. These are predefined view/action helpers.
    |
    */
    'package_helpers' => [
        'view'   => [
            Unckleg\Helpers\Factory\View\Collection\Javascripts::class,
            Unckleg\Helpers\Factory\View\Collection\Stylesheets::class
        ],
        'action' => [
            Unckleg\Helpers\Factory\Action\Collection\Json::class
        ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Directories
    |--------------------------------------------------------------------------
    |
    | The default helpers directory names. Feel free to override it within your app
    | config.
    |
    */
    'directories' => [
        'root'    => 'Helpers',
        'view'    => 'View',
        'action'  => 'Action'
    ]

];