<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Sessions
{
    /**
     * This will retrieve the "Now Playing" Information of the PMS.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getNowPlaying(): StreamInterface|array|string
    {
        $this->apiEndPoint = "status/sessions";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Retrieves a listing of all history views.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getViewsHistory(): StreamInterface|array|string
    {
        $this->apiEndPoint = "status/sessions/history/all";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}