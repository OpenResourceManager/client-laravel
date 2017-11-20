<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 11/20/17
 * Time: 2:59 PM
 */

namespace OpenResourceManager\Laravel\Facade;

use Illuminate\Support\Facades\Facade;

class ORMClient extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'ORMClient';
    }

}