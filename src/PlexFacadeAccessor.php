<?php

namespace Hav2nstd06\LaravelPlex;

use Hav2nstd06\LaravelPlex\Services\Plex as PlexClient;
use Exception;

class PlexFacadeAccessor
{
    /**
     * Plex API provider object.
     */
    public static PlexClient $provider;

    /**
     * Get specific Plex API provider object to use.
     *
     * @throws Exception
     *
     * @return PlexClient
     */
    public static function getProvider(): PlexClient
    {
        return self::$provider;
    }

    /**
     * Set Plex API Client to use.
     *
     * @return PlexClient
     * @throws Exception
     *
     */
    public static function setProvider(): PlexClient
    {
        // Set default provider.
        self::$provider = new PlexClient();

        return self::getProvider();
    }
}
