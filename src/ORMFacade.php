<?php
/**
 * Created by PhpStorm.
 * User: melon
 * Date: 11/20/17
 * Time: 2:59 PM
 */

namespace OpenResourceManager\Laravel;

use Illuminate\Support\Facades\Facade;

class ORMFacade extends Facade
{

    protected static function getFacadeAccessor()
    {
        return 'orm';
    }

}