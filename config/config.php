<?php
/**
 * Plex Setting & API Credentials
 * Created by Thomas <me@hvs.cx>.
 */

return [
    'server_url'    => env('PLEX_SERVER_URL', ''), // Plex Server URL (ex: http://[IP address]:32400)
    'token'         => env('PLEX_TOKEN', ''),

    'validate_ssl'  => env('PLEX_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
