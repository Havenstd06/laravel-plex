<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait ServerIdentity
{
    /**
     * Get server identity details.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getServerIdentity(): StreamInterface|array|string
    {
        $this->apiEndPoint = "identity";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}