
# Laravel Plex
### A Laravel package that allows access to the API of your Plex server.

<p align="center">
    <img height="200" src="https://user-images.githubusercontent.com/33732634/201248345-0df081eb-da1d-4605-92bb-e4c40bfdcd78.png" />   
</p>

## Installation

```bash
composer require hav2nstd06/laravel-plex
```

#### Publish Assets
```bash
php artisan vendor:publish --provider="Hav2nstd06\LaravelPlex\Providers\PlexServiceProvider" 
```

#### Configuration
After publishing the assets, add the following to your .env files .

```env
# Plex API

PLEX_SERVER_URL=
PLEX_TOKEN=
PLEX_VALIDATE_SSL=
```

#### Configuration File
The configuration file plex.php is located in the config folder. Following are its contents when published:

```php
return [
  'server_url'    => env('DEFAULT_PLEX_SERVER_DIRECT_URL', ''), // Plex Server URL (ex: http://[IP address]:32400)
  'token'         => env('DEFAULT_PLEX_ACCOUNT_TOKEN', ''),

  'validate_ssl'  => env('PLEX_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
```
## Usage

#### Initialization

```php
// Import the class namespaces first, before using it directly
use Hav2nstd06\LaravelPlex\Services\Plex as PlexClient;

$provider = new PlexClient;
```

#### Override Configuration
You can override Plex API configuration by calling setApiCredentials method:

```php
$config = [
    'server_url'     => 'https://example.com',
    'token'          => 'your-token',
    'validate_ssl'   => true,
];

$provider->setApiCredentials($config);
```
## Integrations

#### Accounts

**Sign In** to return Plex user data (included token).
```php
$data = [
    'auth' => [
        'username/email', // Required
        'password', // Required
    ],
    'headers' => [ // Headers: https://github.com/Arcanemagus/plex-api/wiki/Plex.tv#request-headers
        'X-Plex-Client-Identifier' => '', // Required - (UUID, serial number, or other number unique per device)
    ]
];

// The second parameter allows you to choose if you want to
// authenticate with the token registered in the config
// (ONLY IF THE TOKEN EXISTS).
$plexUser = $provider->signIn($data, false);
$token = $plexUser['user']['authToken'];
```

```php
$provider->getAccounts();
```

<hr>

#### Libraries

```php
$provider->getLibraries();
```

The key associated with a library. This key can be found by calling the ``getLibraries`` method.
```php
$provider->getLibrary(2);
```

#### Playlists

```php
$provider->getPlaylists();
```

The key associated with a library. This key can be found by calling the ``getPlaylists`` method.
```php
$provider->getPlaylist(2);
```

The key associated with a library. This key can be found by calling the ``getPlaylists`` method.
```php
$provider->getPlaylistItems(2);
```

#### Databases

```php
$provider->downloadDatabases();
```

#### Logs

```php
$provider->downloadLogs();
```

#### Devices

```php
$provider->getDevices();
```

#### ServerCapabilities

```php
$provider->getServerCapabilities();
```

#### ServerIdentity

```php
$provider->getServerIdentity();
```

## Acknowledgements

- [Plexopedia](https://www.plexopedia.com/plex-media-server/api/)
- [Arcanemagus/Plex-API](https://github.com/Arcanemagus/plex-api/wiki)


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Contributing

Pull requests are welcome.  
For major changes, please open an issue first to discuss what you would like to change.  
Please make sure to update tests as appropriate.

