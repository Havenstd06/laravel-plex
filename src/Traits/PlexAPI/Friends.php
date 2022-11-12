<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Havenstd06\LaravelPlex\Classes\InviteFriendsSettings;
use Psr\Http\Message\StreamInterface;

trait Friends
{
    /**
     * Get shares friends list.
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getFriends(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/v2/friends";

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

    /**
     * Remove friend
     *
     * @param int $id
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function removeFriend(int $id): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/v2/friends/{$id}";

        $this->verb = 'delete';

        return $this->doPlexRequest();
    }

    /**
     * Get friends details
     *
     * @param int $id
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getFriendDetail(int $id): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/v2/friends/{$id}";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Update friend restrictions
     *
     * @param int $id // friend ID / InvitedID
     * @param InviteFriendsSettings $settings
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function updateFriendRestriction(int $id, InviteFriendsSettings $settings = new InviteFriendsSettings): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/friends/{$id}";

        $this->options['json'] = $settings->toArray();

        $this->verb = 'put';

        return $this->doPlexRequest();
    }

    /**
     * Update friend Libraries
     *
     * @param int $id // friend ID / InvitedID
     * @param array|null $librariesIds
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function updateFriendLibraries(int $id, array $librariesIds = null): StreamInterface|array|string
    {
        // get server identity before changing ApiBase URL
        $machineIdentifier = $this->getServerIdentity()['MediaContainer']['machineIdentifier'];

        // return if $machineIdentifier is not found
        if (! isset($machineIdentifier)) {
            return false;
        }

        if (empty($librariesIds)) {
            $libraries = $this->getServerDetail()['MediaContainer']['children'][0]['Server']['children'];

            foreach ($libraries as $library) {
                $librariesIds[] = (int) $library['Section']['id'];
            }
        }

        $friendSharedServers = $this->getFriendDetail($id)['sharedServers'];

        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        // Get the first shared_servers (see api/v2/friends/{$id})
        $this->apiEndPoint = "api/v2/shared_servers/{$friendSharedServers[0]['id']}";

        $data = [
            'librarySectionIds' => $librariesIds,
            'machineIdentifier' => $machineIdentifier,
        ];

        $this->options['json'] = $data;

        $this->verb = 'post';

        return $this->doPlexRequest();
    }

    /**
     * Get pending invitations list
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getPendingInvites(): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['plex_tv_api_url'];

        $this->apiEndPoint = "api/v2/friends/invites/sent/pending";

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}