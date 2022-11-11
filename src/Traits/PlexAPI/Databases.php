<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Databases
{
    /**
     * Download databases details.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function downloadDatabases(): StreamInterface|array|string
    {
        $this->apiEndPoint = "diagnostics/databases";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}