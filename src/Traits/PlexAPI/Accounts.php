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
}