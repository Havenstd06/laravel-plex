<?php

namespace Havenstd06\LaravelPlex\Traits;

use Havenstd06\LaravelPlex\Traits\PlexAPI\Accounts;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Databases;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Devices;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Libraries;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Logs;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Medias;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Playlists;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Friends;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Resources;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Servers;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Sessions;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Shared;
use Havenstd06\LaravelPlex\Traits\PlexAPI\System;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Translations;
use Havenstd06\LaravelPlex\Traits\PlexAPI\Users;

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
    use Friends;
    use Translations;
    use Resources;
}