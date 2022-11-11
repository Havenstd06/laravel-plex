<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Databases
{
    /**
     * This will search the in database for the string provided.
     *
     * @param string $query
     * @return array|StreamInterface|string
     *
     * @throws \Throwable
     */
    public function searchDatabase(string $query): StreamInterface|array|string
    {
        $this->apiEndPoint = "search";

        $this->setRequestQuery('query', $query);

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}