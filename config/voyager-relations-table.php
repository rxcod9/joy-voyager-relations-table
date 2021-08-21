<?php

return [

    /*
     * The config_key for voyager-relations-table package.
     */
    'config_key' => env('VOYAGER_RELATIONS_TABLE_CONFIG_KEY', 'joy-voyager-relations-table'),

    /*
     * The route_prefix for voyager-relations-table package.
     */
    'route_prefix' => env('VOYAGER_RELATIONS_TABLE_ROUTE_PREFIX', 'joy-voyager-relations-table'),

    /*
    |--------------------------------------------------------------------------
    | Controllers config
    |--------------------------------------------------------------------------
    |
    | Here you can specify voyager controller settings
    |
    */

    'controllers' => [
        'namespace' => 'Joy\\VoyagerRelationsTable\\Http\\Controllers',
    ],
];
