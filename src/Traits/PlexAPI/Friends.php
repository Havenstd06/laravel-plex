<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Havenstd06\LaravelPlex\Classes\InviteFriendsSettings;
use Psr\Http\Message\StreamInterface;

trait Friends
{
    /**
     * Get PMS server shares
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getFriends(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "pms/friends/all";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Get PMS server share requests
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getFriendsRequests(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "pms/friends/requests";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Invite friend to your server
     *
     * @param string $email
     * @param array $librariesIds
     * @param InviteFriendsSettings $settings
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function inviteFriend(string $email, array $librariesIds = [], InviteFriendsSettings $settings = new InviteFriendsSettings): StreamInterface|array|string
    {
        // get server identity before changing ApiBase URL
        $machineIdentifier = $this->getServerIdentity()['MediaContainer']['machineIdentifier'];

        // if $librariesIds is empty get all servers libraries
        if (empty($librariesIds)) {
            $libraries = $this->getServerDetail()['MediaContainer']['children'][0]['Server']['children'];

            foreach ($libraries as $library) {
                $librariesIds[] = (int) $library['Section']['id'];
            }
        }

        // return if $machineIdentifier is not found
        if (! isset($machineIdentifier)) {
            return false;
        }

        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/v2/shared_servers";

        $data = [
            'invitedEmail' => $email,
            'librarySectionIds' => $librariesIds,
            'machineIdentifier' => $machineIdentifier,
            'settings' => $settings->toArray()
        ];

        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPlexRequest();
    }

    /**
     * Cancel friend invitation
     *
     * @param string $email
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function cancelInvite(string $email): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/v2/friends/invite";

        $this->setRequestQuery('identifier', $email);

        $this->verb = 'delete';

        return $this->doPlexRequest(false);
    }
}