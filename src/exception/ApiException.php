<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 1/26/18
 * Time: 2:43 PM
 */

namespace OpenResourceManager\Laravel\Exception;

use HttpException;
use Throwable;

class ApiException extends HttpException
{

    private $statusCode;

    private $headers;

    public function __construct($message = "", $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function getHeaders()
    {
        return $this->headers;
    }

    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

}