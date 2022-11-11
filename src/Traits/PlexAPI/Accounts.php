<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Accounts
{
    /**
     * Get accounts details.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getAccounts(): StreamInterface|array|string
    {
        $this->apiEndPoint = "accounts";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get Plex.TV account information.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     *
     */
    public function getPlexAccount(): StreamInterface|array|string
    {
        $this->apiEndPoint = "myplex/account";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}