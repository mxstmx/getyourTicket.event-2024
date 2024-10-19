<?php

namespace Facades\Classiebit\Eventmie;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Classiebit\Eventmie\Eventmie
 */
class Eventmie extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'Classiebit\Eventmie\Eventmie';
    }
}
