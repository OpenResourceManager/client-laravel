<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 11/20/17
 * Time: 2:58 PM
 */

namespace OpenResourceManager\Laravel;

use OpenResourceManager\ORM;

class ORMService
{
    private $orm;

    public function __construct($secret, $host, $version, $port, $useSSL)
    {
        $mSecret = $this->validate($secret, null);
        $mHost = $this->validate($host, null);
        $mVersion = $this->validate($version, 1);
        $mPort = $this->validate($port, 80);
        $mUseSSL = $this->validate($useSSL, false);
        $this->orm = new ORM($mSecret, $mHost, $mVersion, $mPort, $mUseSSL);
    }

    private function validate($val, $default, $json = false)
    {
        if (!is_null($val)) {
            if ($json) {
                return json_decode($val, true);
            }
            return $val;
        }
        return $default;
    }

    public function get()
    {
        return $this->orm;
    }

}