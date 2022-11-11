<?php

namespace Hav2nstd06\LaravelPlex\Traits;

use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Accounts;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Databases;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Devices;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Libraries;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Logs;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Playlists;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\ServerCapabilities;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\ServerIdentity;

trait PlexAPI
{
    use ServerCapabilities;
    use ServerIdentity;
    use Libraries;
    use Accounts;
    use Devices;
    use Databases;
    use Logs;
    use Playlists;
}