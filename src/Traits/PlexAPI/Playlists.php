<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Playlists
{
    /**
     * Get playlists list.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getPlaylists(): StreamInterface|array|string
    {
        $this->apiEndPoint = "playlists";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get playlist detail.
     *
     * @param string $playlistId
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getPlaylist(string $playlistId): StreamInterface|array|string
    {
        $this->apiEndPoint = "playlists/{$playlistId}";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get playlist items detail.
     *
     * @param string $playlistId
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getPlaylistItems(string $playlistId): StreamInterface|array|string
    {
        $this->apiEndPoint = "playlists/{$playlistId}/items";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}