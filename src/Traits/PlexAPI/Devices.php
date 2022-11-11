<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Devices
{
    /**
     * Get devices details.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getDevices(): StreamInterface|array|string
    {
        $this->apiEndPoint = "devices";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}