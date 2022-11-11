<?php

namespace Havenstd06\LaravelPlex\Services;

use Havenstd06\LaravelPlex\Traits\PlexRequest;
use Exception;

class Plex
{
    use PlexRequest;

    /**
     * Plex constructor.
     *
     * @param array $config
     *
     * @throws Exception
     */
    public function __construct(array $config = [])
    {
        // Setting Plex API Credentials
        $this->setConfig($config);

        $this->httpBodyParam = 'form_params';

        $this->setRequestHeader('Accept', 'application/json');
    }

    /**
     * Set API options.
     *
     * @param array $credentials
     */
    protected function setOptions(array $credentials): void
    {
        // Setting API Endpoint
        $this->config['server_api_url'] = $credentials['server_url'];

        $this->config['plex_tv_api_url'] = 'https://plex.tv';
    }
}
