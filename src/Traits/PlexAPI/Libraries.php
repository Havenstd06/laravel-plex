<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Libraries
{
    /**
     * Get libraries lists.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getLibraries(): StreamInterface|array|string
    {
        $this->apiEndPoint = "library/sections";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get all data from library.
     *
     * @param string $libraryId
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getLibrary(string $libraryId): StreamInterface|array|string
    {
        $this->apiEndPoint = "library/sections/{$libraryId}/all";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}