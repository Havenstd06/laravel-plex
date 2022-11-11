<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Servers
{
    /**
     * Get the local List of servers.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getServers(): StreamInterface|array|string
    {
        $this->apiEndPoint = "servers";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get simple list of servers
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getSimpleServers(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "pms/servers.xml?includeLite=1";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get server capabilities details.
     * Transcode bitrate info, server info.
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

    /**
     * Gets the server preferences.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getServerPreferences(): StreamInterface|array|string
    {
        $this->apiEndPoint = ":/prefs";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}