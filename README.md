
# Laravel Plex
### A Laravel package that allows access to the API of your Plex server.

<p align="center">
    <img height="200" src="https://user-images.githubusercontent.com/33732634/201248345-0df081eb-da1d-4605-92bb-e4c40bfdcd78.png" />   
</p>

## Installation

```bash
composer require havenstd06/laravel-plex
```

#### Publish Assets
```bash
php artisan vendor:publish --provider="Havenstd06\LaravelPlex\Providers\PlexServiceProvider" 
```

#### Configuration
After publishing the assets, add the following to your .env files .

```env
# Plex API
PLEX_SERVER_URL=
PLEX_TOKEN=

PLEX_CLIENT_IDENTIFIER=
PLEX_PRODUCT=havenstd06/laravel-plex
PLEX_VERSION=1.0.0

PLEX_VALIDATE_SSL=true
```

#### Configuration File
The configuration file plex.php is located in the config folder. Following are its contents when published:

```php
return [
    'server_url'         => env('PLEX_SERVER_URL', ''), // Plex Server URL (ex: http://[IP address]:32400)
    'token'              => env('PLEX_TOKEN', ''),

    'client_identifier'  => env('PLEX_CLIENT_IDENTIFIER', ''), // (UUID, serial number, or other number unique per device)
    'product'            => env('PLEX_PRODUCT', 'havenstd06/laravel-plex'), // (Plex application name, eg Laika, Plex Media Server, Media Link)
    'version'            => env('PLEX_VERSION', '1.0.0'), // (Plex application version number)

    'validate_ssl'       => env('PLEX_VALIDATE_SSL', true), // Validate SSL when creating api client.
];
```
## Usage

#### Initialization

```php
use Havenstd06\LaravelPlex\Services\Plex as PlexClient;

$provider = new PlexClient;
```

#### Override Configuration
You can override Plex API configuration by calling setApiCredentials method:

```php
$config = [
    'server_url'        => 'https://example.com',
    'token'             => 'your-token',
    
    'client_identifier' => 'your-client-identifier',
    'product'           => 'your-product',
    'version'           => 'your-version',
    
    'validate_ssl'      => true,
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
    'headers' => [
        // Headers: https://github.com/Arcanemagus/plex-api/wiki/Plex.tv#request-headers
        // X-Plex-Client-Identifier is already defined in default config file
    ]
];

// The second parameter allows you to choose if you want to
// authenticate with the token registered in the config
// (ONLY IF THE TOKEN EXISTS).
$plexUser = $provider->signIn($data, false);
$token = $plexUser['user']['authToken'];
```

Get server accounts details.
```php
$provider->getAccounts();
```

Get account information
```php
$provider->getPlexAccount();
```

Get Plex.TV account information.
```php
$provider->getServerPlexAccount();
```

<hr>

#### Users

List all home users, including guests (Users & Sharing in UI)
```php
$provider->getUsers();
```

Validate username or email
```php
$provider->validateUser('username | email');
```

<hr>

#### Friends

Get shares friends list.
```php
$provider->getFriends();
```

Invite a friend.  
If you don't pass an array with the library ids (`$librarySectionIds`), all the libraries of the server will be taken.
Settings are optional too.

```php
use Havenstd06\LaravelPlex\Classes\FriendRestrictionsSettings;

$librarySectionIds = [
    652397653,
    765367227,
    887542234
];

$settings = new FriendRestrictionsSettings(
    allowChannels: '1',
    allowSubtitleAdmin: '1',
    allowSync: '0',
    allowTuners: '0',
    filterMovies: '',
    filterMusic: '',
    filterTelevision: '',
);

$provider->inviteFriend('me@hvs.cx', $librarySectionIds, $settings);
```

Cancel invitation.
```php
$provider->cancelInvite('me@hvs.cx');
```

Get pending invitations list.
```php
$provider->getPendingInvites();
```

Remove friend.
```php
$provider->removeFriend(12345678); // Friend ID / InvitedID
```

Get friends details
```php
$provider->getFriendDetail(12345678); // Friend ID / InvitedID
```

Update friend restrictions

```php
use Havenstd06\LaravelPlex\Classes\FriendRestrictionsSettings;

$settings = new FriendRestrictionsSettings(
    allowChannels: '1',
    allowSubtitleAdmin: '1',
    allowSync: '0',
    allowTuners: '0',
    filterMovies: '',
    filterMusic: '',
    filterTelevision: '',
);

$provider->updateFriendRestrictions(12345678, $settings); // Friend ID / InvitedID
```

Update friend libraries
```php
$librarySectionIds = [
    652397653,
    765367227,
    887542234
];

$provider->updateFriendLibraries(12345678, $librarySectionIds); // Friend ID / InvitedID
```

<hr>

#### Server

Get the local List of servers.
```php
$provider->getServers();
```

Get servers detail (contain libraries ids)

```php
$provider->getServerDetail($machineIdentifier); // optional argument
```

Get server identity details
```php
$provider->getServerIdentity();
```

Gets a list of servers and their sections. Limited to servers that have remote access enabled.
The second parameter is for include lite.
```php
$provider->getPmsServers(true);
```

Get server capabilities details. Transcode bitrate info, server info.
```php
$provider->getServerCapabilities();
```

Gets the server preferences.
```php
$provider->getServerPreferences();
```

<hr>

#### System

General plex system information.
```php
$provider->getSystem();
```

Agents available (and some of their configuration)
```php
$provider->getSystemAgents();
```

<hr>

#### Databases

This will search in the database for the string provided.
```php
$provider->searchDatabase('Avengers');
```

<hr>

#### Sessions

This will retrieve the "Now Playing" Information of the PMS.
```php
$provider->getNowPlaying();
```

Retrieves a listing of all history views.
```php
$provider->getViewsHistory();
```

<hr>

#### Devices

Gets a list of available clients and servers.
```php
$provider->getDevices();
```

Get servers devices details.
```php
$provider->getDevices();
```

<hr>

#### Resources

Gets a list of servers, devices and their sections
```php
$provider->getResources();
```

<hr>

#### Libraries

This will search in the library for the string provided. 
The second parameter is the limit.
```php
$provider->searchLibrary('Avengers', 10);
```

Show ondeck list
```php
$provider->getOnDeck();
```

Contains all of the sections on the PMS.
Confusingly, Plex's UI calls a section a library: e.g. "TV shows" or "Movies".
This acts as a directory and you are able to "walk" through it.
```php
$provider->getLibraries();
```

Get all data in the library for the section passed in.
```php
$provider->getLibrary(1);
```

Delete a section
```php
$provider->deleteLibrary(1);
```

Refreshes the library for the section passed in.
```php
$provider->refreshLibrary(1);
```

<hr>

#### Playlists

Get playlists list.
```php
$provider->getPlaylists();
```

The key associated with a library.  
This key can be found by calling the ``getPlaylists`` method.
```php
$provider->getPlaylist(2);
```

The key associated with a library.  
This key can be found by calling the ``getPlaylists`` method.
```php
$provider->getPlaylistItems(2);
```

<hr>

#### Medias

Get photo of specified height and width.
```php
$provider->getPhoto('path', 480, 719);
```

Ask the server whether it can provide the video with/without transcoding (based on the client profile).
```php
$provider->getVideo('path', 'http');
```

Marks item with the corresponding "rating key" as watched.
```php
$provider->scrobble('item rating key');
```

Marks item with the corresponding "rating key" as unwatched.
```php
$provider->unscrobble('item rating key');
```

Marks media item with the corresponding "rating key" as partially watched, populating its "viewOffset" field.  
Time is in milliseconds.
```php
$provider->progress('item rating key', 'offset');
```

<hr>

#### Translations

Get Translations for example: fr
```php
$provider->getTranslations('fr');
```

<hr>

## Acknowledgements

- [Plexopedia](https://www.plexopedia.com/plex-media-server/api/)
- [Arcanemagus/Plex-API](https://github.com/Arcanemagus/plex-api/wiki)


## License

[MIT](https://choosealicense.com/licenses/mit/)


## Contributing

Pull requests are welcome.  
For major changes, please open an issue first to discuss what you would like to change.  
Please make sure to update tests as appropriate.

