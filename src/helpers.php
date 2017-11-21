<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 11/21/17
 * Time: 3:57 PM
 */

use OpenResourceManager\Laravel\Facade\ORM;

/**
 * Get an ORM connection
 *
 * Reads environment vars and returns an ORM connection.
 *
 * @return ORM
 */
function getORMConnection()
{
    return ORM::get();
}
