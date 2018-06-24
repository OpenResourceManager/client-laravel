<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 11/20/17
 * Time: 3:37 PM
 */

return [

    /*
     * Your ORM API key
     */
    'secret' => env('ORM_SECRET'),

    /*
     * The host name or IP address that should be used to connect to ORM
     *
     * eg: localhost
     * eg: orm.example.com
     * eg: 10.10.10.10
     *
     */
    'host' => env('ORM_HOST', 'localhost'),

    /*
     * The port that your ORM API is configured to listen on
     *
     * eg: 80 (plain text)
     * eg: 443 (https)
     *
     */
    'port' => env('ORM_PORT', 80),

    /*
     * Does your ORM instance use SSL / HTTPS?
     */
    'use_ssl' => env('ORM_SSL', false),

    /*
     * How long trait responses should remain in the cache in minutes. False or 0 to disable.
     */
    'trait_response_cache_time' => env('ORM_TRAIT_CACHE_TTL', false)
];