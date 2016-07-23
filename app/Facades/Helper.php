<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * This is the helper facade class.
 *
 * @author Ravend <ravend6@gmail.com>
 */
class Helper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'helper';
    }
}
