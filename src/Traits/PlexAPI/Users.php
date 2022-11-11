<?php

namespace Hav2nstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Users
{
    /**
     * List all home users, including guests (Users & Sharing in UI)
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getUsers(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/v2/home/users";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Validate username or email
     *
     * @param string $account
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function validateUser(string $account): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/users/validate.json";

        $this->setRequestQuery('invited_email', $account);

        $this->verb = 'post';

        return $this->doPlexRequest();
    }
}