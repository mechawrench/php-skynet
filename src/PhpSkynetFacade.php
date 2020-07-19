<?php

namespace Mechawrench\PhpSkynet;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Mechawrench\PhpSkynet\PhpSkynet
 */
class PhpSkynetFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'php-skynet';
    }
}
