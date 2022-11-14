<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Devices
{
    /**
     * Gets a list of available clients and servers
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getDevices(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "devices.json";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get servers devices details.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getServerDevices(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['server_api_url'];

        $this->apiEndPoint = "devices";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}