<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait System
{
    /**
     * General plex system information
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getSystem(): StreamInterface|array|string
    {
        $this->apiEndPoint = "system";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Agents available (and some of their configuration)
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getSystemAgents(): StreamInterface|array|string
    {
        $this->apiEndPoint = "system/agents";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}