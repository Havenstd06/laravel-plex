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
        $this->apiBaseUrl = $this->config['server_api_url'];

        $this->apiEndPoint = "servers";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Gets a list of servers and their sections. Limited to servers that have remote access enabled
     *
     * @param bool $lite
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getPmsServers(bool $lite = false): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "pms/servers.xml";

        if ($lite) {
            $this->setRequestQuery('includeLite', '1');
        }

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
        $this->apiBaseUrl = $this->config['server_api_url'];

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
        $this->apiBaseUrl = $this->config['server_api_url'];

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
        $this->apiBaseUrl = $this->config['server_api_url'];

        $this->apiEndPoint = ":/prefs";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get servers detail (contain libraries ids)
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getServerDetail(?string $machineIdentifier = null): StreamInterface|array|string
    {
        if (! $machineIdentifier) {
            $machineIdentifier = $this->getServerIdentity()['MediaContainer']['machineIdentifier'];
        }

        if (! isset($machineIdentifier)) {
            return false;
        }

        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/servers/{$machineIdentifier}";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}