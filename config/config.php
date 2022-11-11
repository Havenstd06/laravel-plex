<?php
/**
 * Plex Setting & API Credentials
 * Created by Thomas <me@hvs.cx>.
 */

return [
    'server_url'        => env('PLEX_SERVER_URL', ''), // Plex Server URL (ex: http://[IP address]:32400)
    'token'             => env('PLEX_TOKEN', ''),

    'client_identifier'  => env('PLEX_CLIENT_IDENTIFIER', ''), // (UUID, serial number, or other number unique per device)
    'product'           => env('PLEX_PRODUCT', 'havenstd06/laravel-plex'), // (Plex application name, eg Laika, Plex Media Server, Media Link)
    'version'           => env('PLEX_VERSION', '1.0.0'), // (Plex application version number)

    'validate_ssl'  => env('PLEX_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
