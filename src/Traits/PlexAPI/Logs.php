<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Logs
{
    /**
     * Download Logs details.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function downloadLogs(): StreamInterface|array|string
    {
        $this->apiEndPoint = "diagnostics/logs";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}