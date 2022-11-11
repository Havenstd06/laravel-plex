<?php

namespace Hav2nstd06\LaravelPlex\Facades;

/*
 * Class Facade
 * @package Hav2nstd06\LaravelPlex
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
        return 'Hav2nstd06\LaravelPlex\PlexFacadeAccessor';
    }
}
