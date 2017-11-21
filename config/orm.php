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
     * Session TTL
     *
     * How long to cache ORM session for re-use to avoid repeated authentication attempts
     *
     * To be safe subtract 1 minute from JWT TTL on the ORM server
     *
     * Default: 59
     *
     */
    'ttl' => env('ORM_SESSION_TTL', 59),
];