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
    public function getPlexAccount(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "users/account.json";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get account information
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
    public function getServerPlexAccount(): StreamInterface|array|string
    {
        $this->apiEndPoint = "myplex/account";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Use basic auth to Sign in to plex.tv for validating plex username/password and receive an auth token
     *
     * @param array $data
     * @param bool $useHeaderToken
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function signIn(array $data, bool $useHeaderToken = false): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "users/sign_in.json";

        if (isset($data['auth']) && (! $useHeaderToken || empty($this->config['token']))) {
            $this->removeRequestHeader('X-Plex-Token');
        }

        if (isset($data['auth'])) {
            $this->options['auth'] = $data['auth'];
        }

        if (isset($data['headers'])) {
            $this->setArrayRequestHeader($data['headers']);
        }

        $this->verb = 'post';

        return $this->doPlexRequest();
    }
}