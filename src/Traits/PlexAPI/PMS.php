<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait PMS
{
    /**
     * Get PMS server shares
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getFriends(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "pms/friends/all";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}