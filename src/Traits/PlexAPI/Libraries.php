<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Libraries
{
    /**
     * This will search in the library for the string provided.
     *
     * @param string $query
     * @return array|StreamInterface|string
     *
     * @throws \Throwable
     */
    public function searchLibrary(string $query, int $limit = 20): StreamInterface|array|string
    {
        $this->apiEndPoint = "library/search";

        $this->setRequestQuery('query', $query);
        $this->setRequestQuery('limit', $limit);

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get libraries lists.
     * Contains all of the sections on the PMS.
     * Confusingly, Plex's UI calls a section a library: e.g. "TV shows" or "Movies".
     * This acts as a directory and you are able to "walk" through it.
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

    /**
     * Delete a section
     *
     * @param string $libraryId
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function deleteLibrary(string $libraryId): StreamInterface|array|string
    {
        $this->apiEndPoint = "library/sections/{$libraryId}/all";

        $this->verb = 'delete';

        return $this->doPlexRequest();
    }

    /**
     * Get all data from library.
     * Refreshes the library for the section passed in.
     *
     * @param string $libraryId
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function refreshLibrary(string $libraryId): StreamInterface|array|string
    {
        $this->apiEndPoint = "library/sections/{$libraryId}/refresh";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Show ondeck list
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getOnDeck(): StreamInterface|array|string
    {
        $this->apiEndPoint = "library/onDeck";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}