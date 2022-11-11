<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Resources
{
    /**
     * Gets a list of servers, devices and their sections
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getResources(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/resources";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}