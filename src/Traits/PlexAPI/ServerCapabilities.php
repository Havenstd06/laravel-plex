<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait ServerCapabilities
{
    /**
     * Get server capabilities details.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getServerCapabilities(): StreamInterface|array|string
    {
        $this->apiEndPoint = "/";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}