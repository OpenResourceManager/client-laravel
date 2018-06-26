<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 1/26/18
 * Time: 2:43 PM
 */

namespace OpenResourceManager\Laravel\Exception;

use Exception;

class ApiException extends Exception
{

    public function __construct($message, $code = 500, Exception $previous = null)
    {
        // make sure everything is assigned properly
        parent::__construct($message, $code, $previous);
    }

    // custom string representation of object
    public function __toString()
    {
        return __CLASS__ . ": [{$this->code}]: {$this->message}\n";
    }

}