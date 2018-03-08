<?php

/**
 * The EloWrapper configuration file.
 *
 * Register your own wrappers according the Test wrapper schema below.
 *
 * To create a wrapper use 'php artisan wrapper::generate {name}' command;
 *
 * To create the EloWrapper suitable Eloquent model use 'php artisan wrapper::model {name}' command
 * or extend the existing model with EloWrapper\Models\Model class;
 */
return [

    App\Test::class => [ //Specify the model class
        'test' => EloWrapper\Wrappers\Test::class //Specify the method name and the wrapper class name
    ],
    //Put your wrapper here
];