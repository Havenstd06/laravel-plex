<?php

namespace Havenstd06\LaravelPlex\Traits\PlexAPI;

use Psr\Http\Message\StreamInterface;

trait Medias
{
    /**
     * Get photo of specified height and width
     *
     * @param string $url
     * @param int $width
     * @param int $height
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getPhoto(string $url, int $width = 480, int $height = 719): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['server_api_url'];

        $this->apiEndPoint = "photo/:/transcode";

        $this->setRequestQuery('url', $url);
        $this->setRequestQuery('width', $width);
        $this->setRequestQuery('height', $height);

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Marks item with the corresponding "rating key" as watched.
     *
     * @param string $key // item rating key
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function scrobble(string $key): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['server_api_url'];

        $this->apiEndPoint = ":/scrobble";

        $this->setRequestQuery('key', $key);
        $this->setRequestQuery('identifier', 'com.plexapp.plugins.library');

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Marks item with the corresponding "rating key" as unwatched.
     *
     * @param string $key // item rating key
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function unscrobble(string $key): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['server_api_url'];

        $this->apiEndPoint = ":/unscrobble";

        $this->setRequestQuery('key', $key);
        $this->setRequestQuery('identifier', 'com.plexapp.plugins.library');

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Marks media item with the corresponding "rating key" as partially watched, populating its "viewOffset" field.
     * Time is in milliseconds.
     *
     * @param string $key // item rating key
     * @param int $time // offset
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function progress(string $key, int $time): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['server_api_url'];

        $this->apiEndPoint = ":/progress";

        $this->setRequestQuery('key', $key);
        $this->setRequestQuery('time', $time);
        $this->setRequestQuery('identifier', 'com.plexapp.plugins.library');

        $this->verb = 'get';

        return $this->doPlexRequest();
    }

    /**
     * Ask the server whether it can provide the video with/without transcoding (based on the client profile).
     *
     * @param string $path
     * @param string $protocol
     *
     * @return array|StreamInterface|string
     * @throws \Throwable
     */
    public function getVideo(string $path, string $protocol = 'http'): StreamInterface|array|string
    {
        $this->apiBaseUrl = $this->config['server_api_url'];
        
        $this->apiEndPoint = "video/:/transcode/universal/decision";

        $this->setRequestQuery('path', $path);
        $this->setRequestQuery('protocol', $protocol);
        $this->setRequestQuery('hasMDE', '1');

        $this->verb = 'get';

        return $this->doPlexRequest();
    }
}