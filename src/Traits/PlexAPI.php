<?php

namespace Hav2nstd06\LaravelPlex\Traits;

use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Accounts;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Databases;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Devices;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Libraries;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Logs;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Medias;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Playlists;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Servers;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Sessions;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Shared;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\System;
use Hav2nstd06\LaravelPlex\Traits\PlexAPI\Users;

trait PlexAPI
{
    use Servers;
    use Libraries;
    use Accounts;
    use Devices;
    use Databases;
    use Playlists;
    use Sessions;
    use Medias;
    use System;
    use Users;
}