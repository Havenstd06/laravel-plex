<?php

namespace Havenstd06\LaravelPlex\Facades;

/*
 * Class Facade
 * @package Havenstd06\LaravelPlex
 */

use Illuminate\Support\Facades\Facade;

class Plex extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Havenstd06\LaravelPlex\PlexFacadeAccessor';
    }
}
