<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | Here you can specify package route Eventmie site and admin panel url prefix
    |
    | prefix : null
    | If prefix is null, then Eventmie site url will be example.com
    |
    | prefix : 'events' -> example.com/events
    | Eventmie site url will be example.com/events
    |
    |
    | admin_prefix : 'admin'
    | Eventmie admin panel url will be example.com/<prefix>/admin
    |
    |
    */
    'route' => [
        'prefix'            => null, 
        'admin_prefix'      => 'backstage', // required
    ],


    /*
    |--------------------------------------------------------------------------
    | Multi languages
    |--------------------------------------------------------------------------
    |
    | Remove/Add the languages.
    |
    |
    */
    'locales'       => [
        'de',
    ],

    /*
    |--------------------------------------------------------------------------
    | Detect RTL language
    |--------------------------------------------------------------------------
    |
    | Below are all RTL languages pre defined, and the website direction will 
    | be changed accordingly
    |
    |
    */
    'rtl_langs'        => [
    ],

    /*
    |--------------------------------------------------------------------------
    | Default language
    |--------------------------------------------------------------------------
    |
    | Eventmie default language
    |
    |
    */
    'default_lang'  => 'de',


    /**
     * ADVANCED CONFIGURATIONS. INTERNAL USE ONLY.
     * Change at your own risk 
    */

    /*
    |--------------------------------------------------------------------------
    | Database Config
    |--------------------------------------------------------------------------
    |
    | Here you can specify Eventmie database settings
    |
    */
    'database' => [
        'autoload_migrations' => true,
    ],
    
    /*
    |--------------------------------------------------------------------------
    | Controllers config
    |--------------------------------------------------------------------------
    |
    | Here you can specify eventmie controller settings
    |
    */

    'controllers' => [
        'namespace' => 'App\\Http\\Controllers\\Eventmie',
    ],


];


