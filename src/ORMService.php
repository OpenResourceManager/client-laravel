<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 11/20/17
 * Time: 2:58 PM
 */

namespace OpenResourceManager\Laravel;

use OpenResourceManager\ORM;
use Illuminate\Support\Facades\Cache;

class ORMService
{
    private $orm;

    public function __construct($secret, $host, $version, $port, $useSSL)
    {

        $ormSession = Cache::get('orm_session');
        if (!empty($ormSession)) {
            $this->orm = unserialize($ormSession);
        } else {
            $mSecret = $this->validate($secret, null);
            $mHost = $this->validate($host, null);
            $mVersion = $this->validate($version, 1);
            $mPort = $this->validate($port, 80);
            $mUseSSL = $this->validate($useSSL, false);
            $mORM = new ORM($mSecret, $mHost, $mVersion, $mPort, $mUseSSL);
            $mSessionTTL = (intval($mORM->authResponse->headers['x-jwt-ttl']) - 1);
            if ($mSessionTTL < 1) $mSessionTTL = 1;
            Cache::put('orm_session', serialize($mORM), $mSessionTTL);
            $this->orm = $mORM;
        }
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